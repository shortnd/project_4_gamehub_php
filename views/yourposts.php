<div class="container postContainer">
  <?php if($_SESSION['id']) {?>
  <div class="row">
    <div class="col-8">

      <h2>Your Posts</h2>

      <?php displayPosts("yourPosts"); ?>

    </div>
    <div class="col-4">
      <?php displaySearch(); ?>
      <br/>
      <?php displayPostBox(); ?>
    </div>
  </div>
</div>
<?php } else { ?>
  <div class="container postContainer">
      <header>
          <h1 class="text-hide">Gamehub</h1>
          <img class="img-fluid" src="img/Gamehub_logo.png" alt="Gamehub logo">
      </header>
      <main data-ui-view class="clearfix">
      <div class="container">
          <div class="card">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">
                          <img class="d-block img-fluid" src="img/racing-gaming.jpeg" alt="First slide">
                      </div>
                      <div class="carousel-item">
                          <img class="d-block img-fluid" src="img/keyboard-img.jpeg" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                          <img class="d-block img-fluid" src="img/VR-lady.jpeg" alt="Third slide">
                      </div>
                  </div>
              </div>
              <div class="card-block">
                  <h4 class="card-title">Welcome to Gamehub</h4>
                  <p class="card-text">Gamehub is a social media site for ONLY gamers. Its just like twitter but just for gamers. You can post anything gaming related and talk to other people who also enjoy gaming</p>
                  <div class="alert alert-danger" id="signUpAlert">

                  </div>
                  <input type="hidden" name="signUpActive" id="signUpActive" value="0">
                  <form>
                    <fieldset class="form-group">
                      <label for="userEmail">Email</label>
                      <input type="email" class="form-control" id="userSignUpEmail" placeholder="Email">
                      <label for="userPassword">Password</label>
                      <input type="password" id="userSignUpPassword" class="form-control" placeholder="Password">
                    </fieldset>
                  </form>
                  <button type="button"  class="btn btn-outline-success" id="signUpButton2">Sign Up</button>
                  </form>
              </div>
          </div>
      </div>
    </main>
  </div>
  <?php } ?>
