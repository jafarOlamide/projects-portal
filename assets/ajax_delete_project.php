<?php 
include_once "../admin/config/server.php";
$proj_id = $_POST['proj_id'];

	// Delete Project
	$query = "DELETE FROM projects WHERE project_id =".$proj_id;
	$del_project_query = mysqli_query($connection,$query);
	header("Content-Type: application/json");
	if (!$del_user_query) {
		echo json_encode(['status'=> 0, 'msg'=>"Database Query Failed" . mysqli_error($connection)]);
	} else{
		echo json_encode(['status'=> 1, 'msg'=>'Success']);
	}


?>