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


      if($_GET['action'] == 'toggleFollow'){

        global $link;

        $query = "SELECT * FROM isFollowing WHERE follower = " . mysqli_real_escape_string($link, $_SESSION['id']) ." AND isFollowing =". mysqli_real_escape_string($link, $_POST['userId']) ." LIMIT 1";

        $result = mysqli_query($link, $query);

        // print_r $result;

          if(mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            mysqli_query($link, "DELETE FROM isFollowing WHERE id = ".mysqli_real_escape_string($link, $row['id'])." LIMIT 1");

            echo "1";
          } else {

            mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES (". mysqli_real_escape_string($link, $_SESSION['id'])."," . mysqli_real_escape_string($link, $_POST['userId']). ")");

            echo "2";

          }
        }


      if($_GET['action'] == 'postPost'){
        if(!$_POST['postContent']){
          echo "Please enter some text to post..";
        } else if (strlen($_POST['postContent'] > 140)){
          echo "Your post is too long..";
        } else {
          mysqli_query($link, "INSERT INTO posts (`post`, `userid`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST['postContent'])."', ".mysqli_real_escape_string($link, $_SESSION['id']).", NOW())");
          echo "1";
        }
      }


      if($_GET['action'] == 'signUp'){

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

        if($_POST['signUpActive'] == 0){
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
        }
        else {
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
      // print_r($_POST);
?>
