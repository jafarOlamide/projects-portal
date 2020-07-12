<?php define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php"); 
?>

<?php 
	if ($_GET['login'] && $_GET['login'] == 'true') {
	  $tuser_email = $_POST['user_email'];
	  $user_email = mysqli_real_escape_string($connection, $tuser_email);

      $tuser_password = $_POST['user_password'];
      $user_password = mysqli_real_escape_string($connection, $tuser_password);

      $select_user_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$user_email}'");

      if (mysqli_num_rows($select_user_query) == 0 ) {
        	echo json_encode(['status'=>'wrong_email', 'msg'=>'Account does not exist!']);
      }  else {
             $user_row = mysqli_fetch_assoc($select_user_query);
             if ($user_row['password'] == $user_password ) {
  	              $_SESSION['user_id']  = $user_row['user_id'];  
  	              $_SESSION['firstName']  = $user_row['firstName'];
  	              $_SESSION['lastName']   = $user_row['lastName'];
  	              $_SESSION['user_email'] = $user_row['email'];
  	              $_SESSION['user_role'] = $user_row['user_role'];
              
              echo json_encode(['status'=>'success', 'msg'=>'index.php']);

            } else{
                echo json_encode(['status'=>'wrong_password', 'msg'=>'Wrong password!, Please Input Correct Password']);
            }
        }
	}
?>

<?php 

?>