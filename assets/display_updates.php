<?php 
           session_start();
           if (isset($_POST['login_button'])) {

              $user_email = $_POST['user_email'];
              $user_password = $_POST['user_password'];

              $user_email = mysqli_real_escape_string($connection, $user_email);
              $user_password - mysqli_real_escape_string($connection, $user_password);

              $query = "SELECT * FROM users WHERE email = '{$user_email}' AND password = '{$user_password}'";

              $select_user_query = mysqli_query($connection, $query);
              if (!$select_user_query) {
                        die("Query Failed: " . mysqli_error($connection));
              }

              while ($user_row = mysqli_fetch_assoc($select_user_query)) {

                $db_user_id = $user_row['user_id'];
                $db_email = $user_row['email'];
                $db_password = $user_row['password'];
                $db_first_name = $user_row['firstName'];
                $db_last_name = $user_row['lastName'];
          }   

              $_SESSION['user_id']  = $db_user_id;  
              $_SESSION['firstName']  = $db_first_name;
              $_SESSION['lastName']   = $db_last_name;
              $_SESSION['user_email'] = $db_email ;
              $_SESSION['user_password'] = $db_password;
          }
        ?>
<?php 
include "../server.php";
function display_updates(){
	global $connection;
	if (isset($_GET['update'])) {
                            
      $proj_id = $_GET['update'];
      $display_updates = "SELECT * FROM projects_update WHERE project_id = $proj_id";

      $display_updates_query = mysqli_query($connection,$display_updates);
      if (!$display_updates_query) {
         die("Update Display Query Failed: " . mysqli_error($connection));
      }

      while ($row = mysqli_fetch_assoc($display_updates_query)) {
        $inserted_update = $row['update_text'];
        $project_updated_by = $row['updated_by'];

        if ($project_updated_by == $_SESSION['firstName'] ." " . $_SESSION['lastName']) {
          $project_updated_by = "You";
        }

        $projected_date_updated = $row['date_added'];
        $project_updated_time = date("H:i", strtotime($projected_date_updated));
        $project_updated_date = date("Y-m-d", strtotime($projected_date_updated));

    	//echo "<li class='updates_elem'>" . "<small class='updated_by'>" . $project_updated_by .  "</small>" . $inserted_update . "<small class='updates_time'>" . $project_updated_time ."</small></li>"; 

    	/*$updates_array = array(
				    		'updated_by' => $project_updated_by, 
				    		'inserted_update'=> $inserted_update,
				    		'time_updated' => $project_updated_time
				    		 );
    	echo json_encode($updates_array);*/
   		}
	}     
}

display_updates(); 
?>