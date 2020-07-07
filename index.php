<?php include "admin/includes/headLinks.php"; 
include_once "admin/includes/server.php";
//include_once "admin/includes/sessions.php";


        if (isset($_POST['login_button'])) {

          $tuser_email = filter_var($_POST['user_email'],FILTER_SANITIZE_EMAIL);
          $user_password = $_POST['user_password'];

          $tuser_email = mysqli_real_escape_string($connection, $tuser_email);
          $user_password = mysqli_real_escape_string($connection, $tuser_password);

          $query = "SELECT * FROM users WHERE email = '{$user_email}'";
          $sel_query = mysqli_query($connection, $query);

          if (mysqli_num_rows($sel_query) == 0 ) {
            $_SESSION['message'] = "Account does not exist!";
            header("Location:index.php");
          } else{
            $user_row = mysqli_fetch_assoc($sel_query);
            if ($user_row['password'] == $user_password ) {
              
              $_SESSION['user_id']  = $user_row['user_id'];  
              $_SESSION['firstName']  = $user_row['firstName'];
              $_SESSION['lastName']   = $user_row['lastName'];
              $_SESSION['user_email'] = $user_row['email'];
              $_SESSION['user_role'] = $user_row['user_role'];
              
              //redirect to dashboard page
              header("Location:dashboard.php");
            } else{
                $_SESSION['message'] = "Wrong Password, please input correct Password";
                header("Location:index.php");
            }
          }
        }

      ?>
    <title>Log In</title>
    <link rel="stylesheet" href="css/login_page.css">
  </head>
 <body class="text-center">
    <form action="index.php" method="post" class="form-signin">
      <div  id="a_wrapper">
        <!-- <img src="img/logo-white.png" id="mainone-logo"> -->
        <h1 class="h3 mb-3 font-weight-normal"id="headWord">Projects Portal</h1>
      </div>
      <div class="form-group">
          <div class="login-error"></div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 col-form-label form-labels sr-only">Email</label>
        <div class="col-sm-10" id="email-div">
            <i id="email-ico"><img src="img/user-shape-bl.svg" id="img-email"></i>
            <input type="email" class="form-control inp-fields" name="user_email" placeholder="Email" id="email" >
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 col-form-label form-labels sr-only">Password</label>
        <div class="col-sm-10" id="pass-div">
          <i id="pass-ico"><img src="img/key-black.svg" id="img-pass"></i>
          <input type="password" class="form-control inp-fields" id="password" name="user_password" placeholder="Password">      
        </div>
      </div> 
      <div class="col-sm-10 container">
         <button class="btn btn-lg btn-primary btn-block" type="submit" name="login_button" id="login_button">Sign In</button>
      </div>
  </form>
    <?php include "admin/includes/footerLinks.php"?>
  </body>
<script src="js/login_page.js"></script>
</html>