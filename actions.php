<?php
  include("functions.php");

    if($_GET['action'] == 'loginSignup'){
      if (!$_POST['email']) {
        echo "enter a email address";
      } else if(!$_POST['password']){
        echo "enter a password";
      } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
      }

      if($_POST['loginActive'] == 0){
        echo "sign user up";
      }
      // print_r($_POST);

    }
?>
