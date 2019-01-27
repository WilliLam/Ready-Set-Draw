<?php
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require "drawGame.php";
require_once '../vendor/autoload.php';

class Chat implements MessageComponentInterface {
	protected $clients;
	protected $users;
	protected $gameRoom;
	public function __construct() {
		$this->clients = new \SplObjectStorage;
    echo "Server started!";
	}

	public function onOpen(ConnectionInterface $conn) {

		$count = count($this->clients);
		if($count<2){
			$this->clients->attach($conn);
			echo "New connection! ({$conn->resourceId})\n";
		}else{
			echo "Not any more spaces left!";
		}

	}

	public function onClose(ConnectionInterface $conn) {
		$this->clients->detach($conn);
		echo "Connection {$conn->resourceId} has disconnected\n";
	}

	public function onMessage(ConnectionInterface $from,  $data) {
    $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
		$data = json_decode($data,true);
		$userId = $data['user_id'];
		$roomId = $data['room_id'];
		$side = "";
			$gameRoom = new drawGame();
			if($gameRoom->isRoomAvailable($userId)){
				$gameRoom->joinRoom($userId);
				$side = "right-side";
			}else{
				$gameRoom->createGameRoom($userId);
				$side = "left-side";
			}

			foreach ($this->clients as $client) {
					// if ($from == $client) {
					// 	/
					// 		$data['id']  = "Me";
					// } else {
					// 		$data['from']  = $user['name'];
					// }
					$data['side'] = $side;
					$client->send(json_encode($data));
			}

	}

	public function onError(ConnectionInterface $conn, \Exception $e) {
    echo "An error has occurred: {$e->getMessage()}\n";
		$conn->close();
	}
}
$server = IoServer::factory(
	new HttpServer(new WsServer(new Chat())),
	8080
);
$server->run();
?>
