<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

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