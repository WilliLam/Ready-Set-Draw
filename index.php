<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta property="og:url" content="oururl"/>-->
	<meta property="og:type" content="drawing_for_fun"/>
	<meta property="og:title" content="Ready Set Draw"/>
	<meta property="og:description" content="Fancy of challenging others in drawing? This is your chance to prove yourself
  and compete vs others by drawing and guessing the opponent's drawing oject">

	<meta name="twitter:site" content="@ourcontent">
	<meta name="twitter:title" content="oururl">
	<meta name="twitter:description" content="Fancy of challenging others in drawing? This is your chance to prove yourself
  and compete vs others by drawing and guessing the opponent's drawing oject">

	<meta itemprop="name" content="Read Set Draw">
	<meta itemprop="description" content="Fancy of challenging others in drawing? This is your chance to prove yourself
  and compete vs others by drawing and guessing the opponent's drawing oject">
  <meta name="description" content="Fancy of challenging others in drawing? This is your chance to prove yourself
  and compete vs others by drawing and guessing the opponent's drawing oject" />
  <meta name="keywords" content="drawing, multiplayer, challenging, sketching, game, skills" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Ready Set Draw </title>
  <link rel="icon" href="dist/images/icon.png"/>
  <link rel="stylesheet" id="redux-google-fonts-stm_option-css"
		href="http://fonts.googleapis.com/css?family=Montserrat%3A200%2C500%2C600%2C400%2C700%7COpen+Sans%3A300%2C400%2C600%2C700%2C800%2C300italic%2C400italic%2C600italic%2C700italic%2C800italic&#038;subset=latin&#038;ver=1536658178"
		type="text/css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="dist/css/main.css">
  <link href="dist/fontawesome/css/all.css" rel="stylesheet">


</head>
<body class="landingPage">

  <div class="mainPage_landingDiv">
    <div class="landingDiv_backgroundImg">
      <div class="backgroundImage_des">
        <video autoplay loop muted>
          <source src="dist/readysetdraw.mp4" type="video/mp4">
        </video>
        <div class="background_image_color"></div>
      </div>
      <div class="landingPage_content">
        <div class="landingPage_content_wrapper">
          <h1 class="yell">Welcome To </h1>
          <h1>Ready Set Draw!</h1>
          <h3>Ready to challenge your friends into a drawing duel? Get started now!</h3>
          <a class="join_now" href="register.php">Join Now</a>
        </div>
      </div>
    </div>
  </div>
  <div class="mainPage_landing_features">
    <div class="container_inner">
      <h2>Features of Ready Set Draw</h2>
      <div class="feature_categories_cont row-col">
        <div class="category col-md-3 col-xs-6">
          <div class="category_image messaging_system">
            <img src="dist/images/message.svg">
          </div>
          <h3 class="category_untitle">Messaging System</h3>
        </div>
        <div class="category col-md-3 col-xs-6">
          <div class="category_image testQuiz">
            <img src="dist/images/quiz.svg">
          </div>
          <h3 class="category_untitle">Instant Results</h3>
        </div>
        <div class="category col-md-3 col-xs-6">
          <div class="category_image amazingPanels">
            <img src="dist/images/code_rocket.svg">
          </div>
          <h3 class="category_untitle">Real Time</h3>
        </div>
        <div class="category col-md-3 col-xs-6">
          <div class="category_image announcments">
            <img src="dist/images/megaphone.svg">
          </div>
          <h3 class="category_untitle">Multiplayer</h3>
        </div>
      </div>
    </div>
  </div>

<?php
  include_once('include/footer.php');
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="dist/js/main.js"></script>

<script>

// Landing bg
  var c = 1200; //changing height
  var w = 1000; //general height
  var t = 337; //general top
  var m = 250; //general left
  var q = 60; //max top
  var l = 30; //max left
  $(window).on("resize",function(){
    updateLanding();
  });


updateLanding();
$(document).ready(function(){
  updateLanding();
});

function updateLanding(){
  var y = $(window).width();
  if(y<c){
    var z = w- Math.round((c - y)/2.5);
    var b = t - Math.round((c - y)/2.5);
    $(".mainPage_landingDiv").css("height",z+"px");
    if(b>q){
      $(".landingPage_content_wrapper").css("top",b+"px");
    }else{
      $(".landingPage_content_wrapper").css("top",q+"px");
    }
  }else{
    $(".mainPage_landingDiv").css("height",w+"px");
    $(".landingPage_content_wrapper").css("top",t+"px");
    $(".landingPage_content_wrapper").css("left",m+"px");
  }

  var a = m - Math.round((c - y)/2);
  if(a > l){
    $(".landingPage_content_wrapper").css("left",a+"px");
  }else{
    $(".landingPage_content_wrapper").css("left",l+"px");
  }
}

</script>

</body>
</html>
