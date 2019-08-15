<?php

  session_start();

  // $link = mysqli_connect("localhost", "root", "password", "gamehub");
  $link = mysqli_connect("localhost", "root", "", "gamehub");

  if(mysqli_connect_error()){
    print_r(mysqli_connect_error());
    exit();
  }


  if(isset($_GET['function']) == "logout"){
    session_unset();
  }

    function time_since($since) {
      $chunks = array(
          array(60 * 60 * 24 * 365 , 'year'),
          array(60 * 60 * 24 * 30 , 'month'),
          array(60 * 60 * 24 * 7, 'week'),
          array(60 * 60 * 24 , 'day'),
          array(60 * 60 , 'hour'),
          array(60 , 'min'),
          array(1 , 'sec')
      );

      for ($i = 0, $j = count($chunks); $i < $j; $i++) {
          $seconds = $chunks[$i][0];
          $name = $chunks[$i][1];
          if (($count = floor($since / $seconds)) != 0) {
              break;
          }
      }

      $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
      return $print;
    }



    function displayPosts($type){
        global $link;

        if($type == 'public'){

        $whereClause = "";
      } else if($type == "yourPosts"){
        $whereClause = "WHERE userid = " . mysqli_real_escape_string($link, $_SESSION['id']);
      }
      else if($type == "search") {

        echo '<p>Showing results for "'. mysqli_real_escape_string($link, $_GET['q']).'":</p>';


        $whereClause = "WHERE post LIKE '%" . mysqli_real_escape_string($link, $_GET['q'])."%'";
      }
      else if(is_numeric($type)) {
        $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $type ." LIMIT 1");
        $userQueryResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);

        echo "<h2>Posts by: ".mysqli_real_escape_string($link, $user['email'])."</h2>";

        $whereClause = "WHERE userid =" .mysqli_real_escape_string($link, $type);
      } else if($type == 'isFollowing') {
        $query = "SELECT * FROM isFollowing WHERE follower = " . mysqli_real_escape_string($link, $_SESSION['id']);
        $result = mysqli_query($link, $query);
        $whereClause = "";

        while($row = mysqli_fetch_assoc($result)){
          if($whereClause == "") {$whereClause = "WHERE ";}
          else {$whereClause.= " OR";}
          $whereClause.= " userid = ".$row['isFollowing'];
          $res = 1;
        }
        if($res == 1){

        } else {
          echo "Please Select a User to follow to display there posts here.";
        }
      }

      $query = "SELECT * FROM posts ". $whereClause ." ORDER BY `datetime` DESC LIMIT 10";

      $result = mysqli_query($link, $query);

      if(mysqli_num_rows($result) == 0){
        echo "There are no posts to display";
      } else {
        while ($row = mysqli_fetch_assoc($result)){
          $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid']." LIMIT 1");
          $userQueryResult = mysqli_query($link, $userQuery);
          $user = mysqli_fetch_assoc($userQueryResult);

          echo "<div class='card'>";
          echo "<div card='card-block'";
          echo "<div class='card-header'><p><a class='text-success' href='?page=viewprofiles&userid=".$user['id']."'> ".$user['email']."</a> <span class='time'>".@time_since(time()- strtotime($row['datetime']))." ago</span></p>";
          echo "<p class='card-text'>".$row['post']."</p>";
          echo "<p><button class='toggleFollow a btn btn-outline-success' data-userId='".$row['userid']."'>";

          $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = " . mysqli_real_escape_string($link, $_SESSION['id']) ." AND isFollowing =". mysqli_real_escape_string($link, $row['userid']) ." LIMIT 1";

          $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

            if(mysqli_num_rows($isFollowingQueryResult)){
              echo "Unfollow";
            } else {
              echo "Follow";
            }

          echo "</button></p></div>";
          echo "</div>";

        }
      }
    }


    function displaySearch(){
      echo '<div class="form">
              <form class="form-group">
              <input type="hidden" name="page" value="search">
                <input type="text" name="q" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search">

                <button class="btn btn-outline-success searchAndPost">Search</button>
              </form>
            </div>';
    }


    function displayPostBox(){
      if($_SESSION['id'] > 0){
        echo '<br/>
              <div class="header-3"><h3>Write your post:</h3></div>
              <div id="postSuccess" class="alert alert-success" style="display: none;">Your post was successfully posted.</div>
              <div id="postFail" class="alert alert-danger" style="display: none;"></div>
              <div class="form">
                <div class="form-group">
                  <textarea type="text" class="form-control" rows="3" id="postContent" maxlength="140"></textarea>
                  <div id="textarea_feedback"></div>

                  <button class="btn btn-outline-success writePost" id="submitPostButton">Post</button>
                </div>
              </div>';
      }
    }


    function displayUsers(){

      global $link;

      $query = "SELECT * FROM users LIMIT 10";

      $result = mysqli_query($link, $query);

      while($row = mysqli_fetch_assoc($result)){
        echo "<p><a class='text-success' href='?page=viewprofiles&userid=".$row['id']."'>".$row['email']."</a></p>";
      }
    }

 ?>
