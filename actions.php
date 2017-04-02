<?php
  include("functions.php");

  if ($_GET['action'] == "loginSignup"){

    $error = "";

    if (!$_POST["email"]){
      $error = "An email address is required.";
    } else if (!$_POST["password"]){
      $error = "A password is required";
    } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
      $error = "please is a valid email address";
    }

    if ($error == "") echo $error;

    if($_POST['loginActive'] == '0'){
      echo "Sign user up";
    }
  }
?>
