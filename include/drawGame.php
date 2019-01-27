<?php

  include("constantMethods.php");
	class drawGame
	{
		private $gameID;
		private $users;
		private $createdOn;

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setCreatedOn($createdOn) { $this->createdOn = $createdOn; }
		function getCreatedOn() { return $this->createdOn; }

		public function __construct() {

		}

		public function createGameRoom($user_id) {
			$sql = db_query("INSERT INTO Game (user_id, user_2id) VALUES ('$user_id', 0)");

		}


    public function isRoomAvailable($user_id){
      $sql = db_query("SELECT * FROM Game WHERE gameID <> '$user_id' AND user_2id = 0");
      $resultRow = mysqli_num_rows($sql);
      if($resultRow>0){
        return true;
      }else{
        false;
      }
    }

    public function joinRoom($user_id){
      $sql = db_query("INSERT INTO Game (user_id) VALUES ($user_id)");

    }




	}
 ?>
