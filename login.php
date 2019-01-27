<?php
include('include/constantMethods.php');
if(isUserLoggedIn()){
  header("Location: profile.php?id=".getSessionUser_id());
  exit();
}


?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login to Ready Set Sketch" />
    <meta name="keywords" content="drawing, multiplayer, challenging, sketching, game, skills, login," />
    <title>Login| Ready Set Draw </title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/main.css">
    <link rel="icon" href="dist/images/icon.png"/>
    <link href="dist/fontawesome/css/all.css" rel="stylesheet">
  </head>

  <body class="register_9vodraw_login">
    <div class="register_9vodraw_login_wrapper">
      <div class="auth_register_9vodraw_login">
        <div class="auth_9vodraw_logo">
          <span>ReadySetDraw</span>
        </div>
        <div class="auth_9vodraw_body">
          <p class="auth_9vodraw_premsg">Log in to start your session</p>
          <form autocomplete="off">
            <div class="form_9vodraw_group">
              <input type="text" name="user_username" id="login-username" class="input_with_borderErrors" placeholder="Username">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-user"></i>
              </span>
            </div>
            <div class="form_9vodraw_group">
              <input type="password" name="user_password" id="login-password" class="input_with_borderErrors" placeholder="Password">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-key"></i>
              </span>
            </div>
            <button type="submit" name="submit_login" id="submit-login" class="signup_9vodraw_btn">Log in</button>
          </form>
            <p class="have_9vodraw_accountText">Don't have an account?</br> <a href="register.php">Register Now!</a></p>
        </div>
      </div>
    </div>
  </body>
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

</html>
