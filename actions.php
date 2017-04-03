<?php
  include("functions.php");

    if($_GET['action'] == 'loginSignup'){

      $error = "";

      if (!$_POST['email']) {
        $error = "enter a email address";
      } else if(!$_POST['password']){
        $error = "enter a password";
      } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
      }

      if($error != "" ){
        echo $error;
        exit();
      }

      if($_POST['loginActive'] == 0){
        $email = mysqli_real_escape_string($link, $_POST['email']);
        // echo $email;
        $query = "SELECT * FROM users WHERE email = '" . $email ."' LIMIT 1";
        // echo $query;
        $result = mysqli_query($link, $query);

        // print_r $result;

        if(mysqli_num_rows($result)) {
          $error = "That email address is already taken";
        }

      if($error != ''){
        echo $error;
        exit();
      }

      // print_r($_POST);
    }
  }
?>
