<?php
include('include/constantMethods.php');
if(!isUserLoggedIn()){
  header("Location: login.php");
}
$curr_user = getSessionUser_id();
$pro_pic = pro_pic_stat_destination() . get_profile_picture($curr_user);
$user_info = get_user_info($curr_user);

?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your Profile| Ready Set Draw" />
    <meta name="keywords" content="drawing, multiplayer, challenging, sketching, game, skills, login," />
    <title>Your Profile| Ready Set Draw </title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/main.css">
    <link rel="icon" href="dist/images/icon.png"/>
    <link href="dist/fontawesome/css/all.css" rel="stylesheet">
  </head>
  <body class="hubPage">

    <div class="hub_users_container">
      <div class="row-col">
        <div class="col-md-6 col-sm-12 left-side">
          <div class="inner">
            <div class="user_hubcontainer_inner">

            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 right-side">
          <div class="inner">
            <div class="user_hubcontainer_inner">
              <!-- <p class="waiting">Waiting for another user ... </p> -->
              <div class="user_hubcontainer_inner">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="wheel_cont not_shown">
      <div class="spinning_wheel">
        <div class="inner-wheel">
          <div class="cat"><span class="panda"><img src="dist/images/panda.png"></span></div>
          <div class="cat"><span class="cannon"><img src="dist/images/cannon.png"></span></div>
          <div class="cat"><span class="bird"><img src="dist/images/bird.png"></span></div>
          <div class="cat"><span class="house"><img src="dist/images/house.svg"></span></div>
          <div class="cat"><span class="hotdog"><img src="dist/images/hotdog.png"></span></div>
          <div class="cat"><span class="windmill"><img src="dist/images/windmill.svg"></span></div>
        </div>
        <div class="spin">
          <div class="inner-spin"></div>
        </div>
      </div>
    </div>

    <div id="loading-wrapper" class="">
      <div id="loading-text">LOADING</div>
      <div id="loading-content"></div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="dist/js/main.js"></script>
  <?php
  if(isUserLoggedIn()){
 		$user_name = getSessionUser_name();
 		$user_id =getSessionUser_id();
 		$token = getToken($user_id);
 		$email = getEmail($user_id);
 		echo '<script type="text/javascript">
 					var username="'.$user_name.'",
 						user_id="'.$user_id.'",
 						email="'.$email.'",
 						token="'.$token.'";
 					</script>';
 	}
  ?>



  <script>
var degree = 1800;
var clicks = 0;
var closest = 10000;
var choice;

$(document).ready(function(){

  //TODO Fix the wheel
  function rotateWheel(){
    $(".wheel_cont").removeClass("not_shown");
    var newDegree = degree*clicks;
		var extraDegree = Math.floor(2 * (720))+21;
		totalDegree = newDegree+extraDegree;

    $('.spinning_wheel .cat').each(function(){
			var c = 0;
			var n = 700;
			var interval = setInterval(function () {
				c++;
				if (c === n) {
					clearInterval(interval);
				}
			}, 10);

			$('.inner-wheel').css({
				'transform' : 'rotate(' + (totalDegree*3) + 'deg)'
			});


		});
    $(".inner-wheel").bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
      setTimeout(function(){

      }, 500);
     });
  }

});

  </script>

  <script>
  $(document).ready(function(){
    var conn = new WebSocket('ws://localhost:8080');
    var data = {
      user_id: user_id
    }
    conn.onopen = function(e){
      conn.send(JSON.stringify(data));
    }
    conn.onmessage = function(e){

      var data = JSON.parse(e.data);
      console.log(data);
      $("."+data['side']+" .user_hubcontainer_inner").html('<img src="<?php echo $pro_pic ?>"><h1 class="user_name"><?php echo $user_info["firstname"]. " " .$user_info["lastname"]?></h1><p class="wins_stats"><i class="fal fa-trophy-alt"></i>15 Wins</p><p class="loses_stats"><i class="fal fa-flag"></i>10 Loses</p><div class="readyBtnContainer"><button class="button readyBtn">Ready ?</button></div><p class="isReady_txt">Ready!</p>');
    }

  $(".readyBtn").on("click",function(){
    $(this).closest(".user_hubcontainer_inner").find(".isReady_txt").addClass("show");
    $(this).css("display","none");

    conn.send(JSON.stringify(data));
  });

  });

  </script>
  </body>
</html>
