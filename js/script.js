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

  $('#signUpButton2').click(function(){
    // alert("clicked");
    $.ajax({
      type: "POST",
      url: "actions.php?action=signUp",
      data: "email=" + $("#userSignUpEmail").val() + "&password=" + $("#userSignUpPassword").val()
      + "&signUpActive=" + $("#signUpActive").val(),
      success: function(res){
        // alert(res);
        if(res == "1"){
          window.location.assign("index.php");
        } else {
          $('#signUpAlert').html(res).show();
        }
      }

    })
  });

  $('.toggleFollow').click(function(){
    var id = $(this).attr('data-userid');
    var a = $(".a[data-userId='" + $(this).attr('data-userid') + "']");
    $.ajax({
      type: "POST",
      url: "actions.php?action=toggleFollow",
      data: "userId=" + id,
      success: function(res){
        if (res == "1") {
          a.html("Follow");
        } else if (res == "2") {
          a.html("Unfollow");
        }
      }

    })
  })


  $("#submitPostButton").click(function(){
    $.ajax({
      type: "POST",
      url: "actions.php?action=postPost",
      data: "postContent=" + $("#postContent").val(),
      success: function(res){
          if(res == 1){
            location.reload();
            $("#postSuccess").show();
            $("#postFail").hide();
          } else if (res != ""){
            $("#postFail").html(res).show();
            $("#postSuccess").hide();
          } else {
            $("#postFail").hide();
            $("#postSuccess").hide();
          }
        }
      })
    })


    var text_max = 140;
    $('#textarea_feedback').html(text_max + ' characters remaining.');
    $('#postContent').keyup(function(){
      var text_length = $('#postContent').val().length;
      var text_remaining = text_max - text_length;
      $('#textarea_feedback').html(text_remaining + ' characters remaining.');
    });
