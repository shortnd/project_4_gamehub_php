<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gamehub</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="img/Icon.png">
</head>

<body class="background">

  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/~Shortnd">Gamehub</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if (isset($_SESSION['id'])) { ?>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="?page=timeline">Your Timeline</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=yourposts">Your Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=viewprofiles">View Profiles</a>
        </li>
        <?php } else { ?>
        <?php } ?>
      </ul>

      <div class="form-inline my-2 my-lg-0">

        <?php if (isset($_SESSION['id'])) { ?>
        <a class="btn btn-outline-success my-2 my-sm-0" href="?function=logout">Logout</a>
        <?php } else { ?>
        <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#logInModal">Login/Sign Up</button>
        <?php } ?>

      </div>
    </div>
  </nav>