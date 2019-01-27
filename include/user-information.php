<?php

  require __DIR__.'/constantMethods.php';

  ///////////////////////////////////
  // Insert User Information to DB //
  ///////////////////////////////////

if(isset($_GET['action']) && $_GET['action'] == "insert-info" && is_ajax()
    && isset($_POST['user_id'])
    && isset($_POST['token'])
    && isset($_POST['firstname'])
		&& isset($_POST['lastname'])
    && isset($_POST['gender'])
    && isset($_POST['age'])
    && !empty($_POST['token'])
    && !empty($_POST['firstname'])
		&& !empty($_POST['lastname'])
    && !empty($_POST['gender'])
		&& !empty($_POST['age'])){


      $status = 0;
      $error = '';

      // change character set to utf8 and check for errors
      if (!mysqli_set_charset(db_connect(), 'utf8')) {
          $error = mysqli_error(db_connect());
          $status = 0;
      }

      if(!mysqli_errno(db_connect())){

        $user_id = db_escapeString($_POST['user_id']);
        $token = db_escapeString($_POST['token']);

        if(getToken($user_id) == $token){

          $firstname = db_escapeString($_POST['firstname']);
          $lastname = db_escapeString($_POST['lastname']);
          $gender = db_escapeString($_POST['gender']);
          $age = db_escapeString($_POST['age']);
          $image = $_POST['file'];


          //Check if there was a image file uploaded by the user!
          if ($image == null || $image == "undefined" || $image == "") {

            $image_name = def_pro_pic();
            db_query("INSERT INTO user_information (user_id, firstname, lastname, gender, age, profile_pic) VALUES ('$user_id', '$firstname', '$lastname', '$gender', '$age', '$image_name')");
            $status = 1;
          }
          //User uploaded image
          else{
            // Decode the image and put it !
            $image_arr_1 = explode(";", $image);
            $image_arr_2 = explode(",",$image_arr_1[1]);
            $data = base64_decode($image_arr_2[1]);
            $image_name = uniqid() . ".png";
            $image_name_dest = pro_pic_destination() . $image_name;

            file_put_contents($image_name_dest, $data);

            db_query("INSERT INTO user_information (user_id, firstname, lastname, gender, age, profile_pic) VALUES ('$user_id', '$firstname', '$lastname', '$gender', '$age', '$image_name')");
            $status = 1;
          }
        }else{
          $status = 0;
          $error = 'An unknown error has occured! Try again later.';
        }


      }else{
        $error = 'Database connection problem.';
  			$status = 0;
      }



      echo json_encode(
          array(
            'status' =>$status ,
            'error' => $error
          )
      );

}
  

  ?>
