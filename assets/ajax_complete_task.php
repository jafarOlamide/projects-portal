<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

if (isset($_GET['update'])) {
	//$date_completed = $_POST['date_completed'];
	$the_project_id = $_GET['update'];
	$task_id = $_POST['task_id'];
	$task_status = "Completed";
	

	$complete_query = mysqli_query($connection, "UPDATE assign_task SET status = '{$task_status}' WHERE project_id = '{$the_project_id}' AND id = '{$task_id}'");
header('Content-Type: application/json');

	if($complete_query){
		echo json_encode(["status"=>1, "message"=>"Success", "taskStatus"=>$task_status]);
	}else{
		echo json_encode(["status"=>0, "message"=>mysqli_error($connection)]);
	}

}
 ?>