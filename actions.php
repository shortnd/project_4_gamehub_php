<?php
  include("functions.php");

    if($_GET['action'] == 'loginSignup'){

      $error = "";

      if (!$_POST['email']) {
        $error = "Please enter an email address.";
      } else if(!$_POST['password']){
        $error = "Please enter a password";
      } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
      }

      if($error != "" ){
        echo $error;
        exit();
      }

      if($_POST['loginActive'] == 0){
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        // echo $email;
        $query = "SELECT * FROM users WHERE email = '" . $email ."' LIMIT 1";
        // echo $query;
        $result = mysqli_query($link, $query);

        // print_r $result;

          if(mysqli_num_rows($result)) {
            $error = "That email address is already taken";
          } else {
            $query= "INSERT INTO users (`email`, `password`) VALUES ('".$email."','".$password."')";
            if(mysqli_query($link, $query)){

              $_SESSION['id'] = mysqli_insert_id($link);

              $query = "UPDATE users SET password = '". md5(md5($_SESSION['id']).$_POST['password']) ."' WHERE id =
              " . $_SESSION['id']." LIMIT 1";
              mysqli_query($link, $query);
              echo 1;


            } else {
              $error = "Couldn't create user";
            }

          }
      } else {
        $query = "SELECT * FROM users WHERE email = '" . $_POST['email'] ."' LIMIT 1";

        $result = mysqli_query($link, $query);

        $row = mysqli_fetch_assoc($result);

        // echo $row;

          if($row['password'] == md5(md5($row['id']).$_POST['password'])){
            echo 1;

            $_SESSION['id'] = $row['id'];
          } else {
            $error = "Could not find that username/password combination. Please try again.";
          }
        }
      }


      if($error != ''){
        echo $error;
        exit();
      }

      // print_r($_POST);
?>
