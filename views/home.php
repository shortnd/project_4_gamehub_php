<div class="container postContainer">
  <?php if($_SESSION['id']){ ?>
  <div class="row">
    <div class="col-8">
      <h2>Recent Posts</h2>

      <?php displayPosts("public"); ?>

    </div>
    <div class="col-4">
      <?php displaySearch(); ?>
      <br/>
      <?php displayPostBox(); ?>
    </div>
  </div>
  <?php } else { ?>
    <div class="jumbotron center">
      <h1>Sign Up or Sign In to View Site</h1>
    </div>
    <?php } ?>
</div>
