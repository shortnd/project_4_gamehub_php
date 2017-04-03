<?php

  $link = mysqli_connect("localhost", "root", "password", "gamehub");

  if(mysqli_connect_error()){
    print_r(mysqli_connect_error());
    exit();
  }

 ?>
