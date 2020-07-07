$(document).ready(function(){

    //SIGN IN
    $("#login_button").click(function(e){
        var userEmail = $('#email').val();
        var userPassword = $('#password').val();

        e.preventDefault();
        if (userEmail == "" && userPassword == "") {
          $('.login-error').html("Email is required").addClass('form-group');
        } 
         if(userEmail !== "" && userPassword !== ""){
            $.ajax({
            type: "POST",
            url: "assets/ajax_login.php?login=true",
            data: {
                    'user_email': userEmail,
                    'user_password': userPassword
                  },
            dataType: "JSON",
            success: function(res){
                        if (res.status == 'success') {
                          $('.login-error').addClass('login-progress').addClass('form-group');
                          $('.login-error').html("");
                          $('.login-error').css('padding', '0');
                          setTimeout(function(){ 
                              location = res.msg;
                           }, 2000);

                        } else if(res.status == 'wrong_email'){
                            $('.login-error').html(res.msg);
                            $('.login-error').css('padding', '15px');
                        } else if (res.status == 'wrong_password') {
                            $('.login-error').html(res.msg);
                            $('.login-error').css('padding', '15px');
                        }
                    }
            });
        }

    });

 });