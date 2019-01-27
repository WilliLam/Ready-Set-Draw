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
          <span>Ready Set Draw!</span>
        </div>
        <div class="auth_9vodraw_body">
          <p class="auth_9vodraw_premsg">Sign up to start your session</p>
          <form method="post" name="register-form" enctype="multipart/form-data">
            <div class="form_9vodraw_group">
              <input type="text" name="username" id="register-username" placeholder="Username" class="input_with_borderErrors">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-user"></i>
              </span>
            </div>
            <div class="form_9vodraw_group">
              <input type="email" name="email" id="register-email" placeholder="Email" class="input_with_borderErrors">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-envelope"></i>
              </span>
            </div>
            <div class="form_9vodraw_group">
              <input type="password" name="password" id="register-password" placeholder="Password" class="input_with_borderErrors">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-key"></i>
              </span>
            </div>
            <div class="form_9vodraw_group">
              <input type="password" name="repassword" id="register-password2" placeholder="Password (Confirm)" class="input_with_borderErrors">
              <span class="form_9vodraw_group_icon">
                <i class="fal fa-key"></i>
              </span>
            </div>
            <div class="form_9vodraw_checkbox">
              <input type="checkbox" name="terms_checkbox" id="terms_9vodraw_checkbox">
              <label class="form_9vodraw_checkbox_label" for="terms_9vodraw_checkbox">I agree to the <a href="#" target="_blank">Terms & Conditions</a></label>
            </div>
            <button type="submit" name="submit_register" class="signup_9vodraw_btn" id="submit-register">Sign Up</button>
          </form>
            <p class="have_9vodraw_accountText">Already have an account?</br> <a href="login.php">Login Now!</a></p>
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
