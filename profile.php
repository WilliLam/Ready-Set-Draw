<?php
include('include/constantMethods.php');
$curr_user = $_GET['id'];
$pro_pic = pro_pic_stat_destination() . get_profile_picture($curr_user);
$user_info = get_user_info($curr_user);
$user_email = getEmail($curr_user);
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
  <body>
    <div class="mainContainer_wrapper">
      <div class="row-col">
        <div class="col-sm-4">
          <div class="user_profile_card">
            <div class="user_profile_card_bg">
              <img src="dist/images/login_background.jpg">
            </div>
            <div class="user_profile_card_avatar">
              <div class="user_profile_card_avatar_container">
                <img src="<?php echo $pro_pic ?>">
              </div>
              <h5 class="user_name"><?php echo $user_info['firstname'] . " " . $user_info['lastname'] ?></h5>
              <p class="user_email"><?php echo $user_email ?></p>
            </div>
            <div class="user_profile_initStats_cont">
              <ul>
                <li>5<span> Games</span></li>
                <li class="wins">3<span> Wins</span></li>
                <li class="loses">2<span> Loses</span></li>
              </ul>
            </div>
          </div>
          <div class="user_profile_card">
           <div class="user_profile_card_header">
             <h5>About Me</h5>
           </div>
           <div class="user_card_body">
             <span class="card_body_ident"><i class="fal fa-user-secret"></i>Age</span>
             <p><?php echo $user_info['age']; ?></p>
             <hr>
             <span class="card_body_ident"><i class="fal fa-user"></i>Gender</span>
             <p><?php echo $user_info['gender']; ?></p>
           </div>
         </div>
        </div>
        <div class="col-sm-8">
          <div class="user_profile_historyContainer">
            <div class="user_profile_history">
              <div class="no_historyContainer">
                <h3>No Games Played!</h3>
              </div>
            </div>
            <div class="play_nowBtn_container ">
              <button class="play button" id="play">Play Now !</button>
            </div>
          </div>
        </div>
      </div>
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
</body>
</html>
