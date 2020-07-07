<?php 
include_once "../admin/config/server.php";
$admin_ids = $_POST['admin_ids'];

foreach($admin_ids as $admin_id){
	// Delete record
	$query = "DELETE FROM users WHERE user_id = {$admin_id} AND user_role = 'admin'";
	$del_user_query = mysqli_query($connection,$query);
	header("Content-Type: application/json");
	if (!$del_user_query) {
		echo json_encode(['status'=> 0, 'msg'=>"Database Query Failed" . mysqli_error($connection)]);
	} else{
		echo json_encode(['status'=> 1, 'msg'=>'Success']);
	}
}

