<footer class="footer">
<div class="container text-center">
  <p>Created by Collin OConnell</p>
</div>
</footer>



    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Modal -->
    <div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-labelledby="logInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" id="loginAlert">

        </div>
        <input type="hidden" name="loginActive" id="loginActive" value="1">
        <form>
          <fieldset class="form-group">
            <label for="userEmail">Email</label>
            <input type="email" class="form-control" id="userEmail" placeholder="Email" required>
            <label for="userPassword">Password</label>
            <input type="password" id="userPassword" class="form-control" placeholder="Password" required>
          </fieldset>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-primary" id="toggleLogIn">Sign Up</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  class="btn btn-primary" id="loginSignUpButton">Login</button>
      </div>
    </div>
    </div>
    </div>
    <script>
    //This toggles login/sign up form for the moduel
      $('#toggleLogIn').click(function(){
        if ($('#loginActive').val() == "1"){
          $('#loginActive').val("0");
          $('#modalLoginTitle').html("Sign Up");
          $('#loginSignUpButton').html("Sign Up");
          $('#toggleLogIn').html("Login");
          // $('.form-group').append('<div id="confirmPass"></div>');
          // $('#confirmPass').append("<label>Confirm Password</label>");
          // $('#confirmPass').append("<input type='password' class='form-control' placeholder='Confirm Password'>");
        } else {
          $('#loginActive').val("1");
          $('#modalLoginTitle').html("Login");
          $('#loginSignUpButton').html("Login");
          $('#toggleLogIn').html("Sign Up");
          // $('#confirmPass').remove();
        }
      })
      //Ajax to send and get the form info from the action.php
      $('#loginSignUpButton').click(function(){
        $.ajax({
          type: "POST",
          url: "actions.php?action=loginSignup",
          data: "email=" + $("#userEmail").val() + "&password=" + $("#userPassword").val()
          + "&loginActive=" + $("#loginActive").val(),
          success: function(res){
            if(res == "1"){
              window.location.assign("index.php");
            } else {
              $('#loginAlert').html(res).show();
            }
          }

        })
      })

      $('.toggleFollow').click(function(){
        // alert($(this).attr('data-userid'));
        var id = $(this).attr('data-userid');
        var a = $(".a[data-userId='" + $(this).attr('data-userid') + "']");
        $.ajax({
          type: "POST",
          url: "actions.php?action=toggleFollow",
          data: "userId=" + id,
          success: function(res){
            if (res == "1") {

              a.html("Follow");
              // alert(res);

            } else if (res == "2") {

              a.html("Unfollow");
              // alert(res);

            }
          }

        })
      })

    </script>
  </body>
</html>
