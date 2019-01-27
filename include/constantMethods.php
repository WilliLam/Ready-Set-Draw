<?php

session_start();
if (version_compare(PHP_VERSION, '5.5.0', '<')) {
	die("<div style='position:absolute;top:0;left:0;background-color:white;width:100%;height:100%;z-index:999;'><b>Error:</b> Your PHP Version cannot be lower than 5.5.0!</div>");
}
//////////////////////////////////////////////
/////////// CONFIGURATE DATABASE /////////////
//////////////////////////////////////////////

function db_connect()
{
    static $connection;
    if (!isset($connection)) {
	  $serverName = "127.0.0.1";
		$serverUsername = "root";
		$serverPassword = "";
		$serverDatabase="ichack_2019";
		$connection=mysqli_connect($serverName, $serverUsername, $serverPassword, $serverDatabase);
    }

    if ($connection === false) {
        return mysqli_connect_error();
    }

    return $connection;
}

function db_query($query)
{
    $connection = db_connect();
    mysqli_query($connection, "set names 'utf8'");
    $result = mysqli_query($connection, $query);
    return $result;
}

function db_escapeString($value)
{
    return mysqli_real_escape_string(db_connect(), $value);
}



//////////////////////////////////////////////
/////////// CONFIGURATE FUNCTIONS /////////////
//////////////////////////////////////////////

// Checks the connection if it is ajax
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

//Whether the user has to activate his/her account
function user_activation_required(){
		return false;
}

function min_pass_length(){
	return 6;
}

function max_pass_length(){
	return 99;
}

function min_username_length(){
	return 6;
}

function max_username_length(){
	return 55;
}

function img_types_accepted(){

	$types = "png|jpg|jpeg|PNG|JPG|JPEG";
	$extensions = explode('|', $types);
	$tot_ext = count($extensions);
	$array = array();

	for($i=0; $i<$tot_ext; $i++){
		$var = 'image/'.$extensions[$i];
		array_push($array, $var);
	}
	return $array;
}


function pro_pic_destination(){
	return getcwd().'/img/pro_pic/';
}

function pro_pic_stat_destination(){
	return "/include/img/pro_pic/";
}

function def_pro_pic(){
	return "defaultProfilePicture.jpg";
}

function post_img_destination(){
	return './img/post_image/';
}
function post_img_stat_destination(){
	return  "/include/img/post_image/";
}
function get_profile_picture($user_id){
	$user_id = db_escapeString($user_id);
	$query = db_query("SELECT profile_pic FROM user_information WHERE user_id = '$user_id' LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	return $row['profile_pic'];

}
function get_user_info($user_id){
	$user_id = db_escapeString($user_id);
	$query = db_query("SELECT * FROM user_information WHERE user_id = '$user_id' LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$user_info = array();

	$user_info['firstname'] = $row['firstname'];
	$user_info['lastname'] = $row['lastname'];
	$user_info['gender'] = $row['gender'];
	$user_info['age'] = $row['age'];

	return $user_info;
}

//////////////////////////////////////////////
/////////// REGISTRATION & LOGIN /////////////
//////////////////////////////////////////////

//Check if user is logged in
function isUserLoggedIn(){
	if(isset($_SESSION['user_id'])){
		return true;
	}
	else{
		return false;
	}
}

// Get user's name by id
function getUser_name_ById($user_id){
		$query = db_query("SELECT `username` FROM `User` WHERE `ID` = '$user_id' LIMIT 1");
    $row = mysqli_fetch_assoc($query);
    return $row['username'];
}
// get Curernt User ID
function getSessionUser_id()
{
	if(isUserLoggedIn()){
	return $_SESSION['user_id'];
	}
}

//Username
function getSessionUser_name()
{
    if (isUserLoggedIn()) {
        $user_id = getSessionUser_id();
        $result = db_query("SELECT `username` FROM `User` WHERE `ID` = '$user_id'");
        $row = mysqli_fetch_assoc($result);

        return $row['username'];
    }
}

// User's Email Address
function getEmail($user_id)
{
        $user_id = db_escapeString($user_id);
        $result = db_query("SELECT `email` FROM `User` WHERE `ID` = '$user_id'");
        $row = mysqli_fetch_assoc($result);
        return $row['email'];
}

// Get User's Status
function getUser_status($user_id){
	if(isUserLoggedIn()){
		$result = db_query("SELECT `user_status` FROM `users` WHERE `user_id` = '$user_id'");
		$row = mysqli_fetch_assoc($result);

		return $row['user_status'];
	}
}

// Token
function getToken($user_id)
{
		$user_id = db_escapeString($user_id);
    $query = db_query("SELECT `token` FROM `User` WHERE `ID` = '$user_id' LIMIT 1");
    $row = mysqli_fetch_assoc($query);

    return $row['token'];
}

//Check if user's account is user_activation_required
function is_account_activated($user_id)
{
	$user_id = db_escapeString($user_id);
	$query = db_query("SELECT `activation` FROM `User` WHERE `ID` = '$user_id' LIMIT 1");
	$row = mysqli_fetch_assoc($query);

	if($row['activation'] == 0){
		return false;
	}else{
		return true;
	}
}


// Check if user has put his user_information
function is_user_information_registered(){
	if(isUserLoggedIn()){

		$user_id = $_SESSION['user_id'];
		$query = db_query("SELECT * FROM user_information WHERE user_id = '$user_id' LIMIT 1");
		$result = mysqli_num_rows($query);

		if($result > 0){
			return true;
		}else{
			return false;
		}
	}
}





?>
