<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

if (isset($_GET['update'])) {
	$project_id = $_GET['update'];
	$user_id = $_POST['user_ID'];
	$member_role = $_POST['member_role'];
	
	//ADD MEMBER INTO PROJECT
		$query = "INSERT INTO project_members (	
					project_id,
					user_id,
					member_role )  
				SELECT * FROM (SELECT '$project_id','$user_id', '$member_role') AS tmp 
				WHERE NOT EXISTS 
   				(SELECT project_id, user_id FROM project_members WHERE project_id=" . $project_id . " AND user_id=" . $user_id . ")";

		$addmemeber_query = mysqli_query($connection, $query);
		
		if (!$addmemeber_query) {
			echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);
		} else {
			if (mysqli_affected_rows($connection) == 0) {
				header('Content-Type: application/json');
				$error_mess = "<p>Member Already Exists</p>";
				echo json_encode(['err_status'=> 1, 'err_msg'=>$error_mess]);
			} else {
				//GET MEMBER ID FOR NAME
				$new_member_id = mysqli_insert_id($connection);
				header('Content-Type: application/json');
					echo json_encode(['status'=>1, 'msg'=>"Success" , 'new_member'=>$new_member_id]);
			}
		}


		

		
	
		
	
	

	

}

?>