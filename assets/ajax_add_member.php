<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

if (isset($_GET['update'])) {
	$project_id = $_GET['update'];
	$user_id = $_POST['user_ID'];
	$member_role = $_POST['member_role'];

	//QUERY TO CHECK IF USER HAS BEEN ADDED TO PROJECT
	$sel_query = "SELECT * FROM project_members WHERE project_id = {$project_id}  AND user_id = {$user_id} ";
	$check_query = mysqli_query($connection, $sel_query);
	$check_row = mysqli_fetch_assoc($check_query);
		$mem_user_id = $check_row['user_id'];
		$mem_proj_id = $check_row['project_id'];
	if (!isset($mem_user_id) && !isset($mem_proj_id)) {
		//ADD MEMBER INTO PROJECT
		$query = "INSERT INTO project_members (
		 project_id,
		 user_id,
		 member_role
		) VALUES (
		 '$project_id',
		 '$user_id',
		 '$member_role'
	)";

		$addmemeber_query = mysqli_query($connection, $query);
		//GET MEMBER ID FOR NAME
		$new_member_id = mysqli_insert_id($connection);
		header('Content-Type: application/json');
	        
        if (!$addmemeber_query) {
        	echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);
        }

        else{
        	echo json_encode(['status'=>1, 'msg'=>"Success" , 'new_member'=>$new_member_id]);
        }
	} else{
		header('Content-Type: application/json');
		$error_mess = "<p>Member Already Exists</p>";
		echo json_encode(['err_status'=> 1, 'err_msg'=>$error_mess]);
	}
	

	

}

?>