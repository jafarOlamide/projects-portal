<?php 
include_once "../admin/config/server.php";
if (isset($_GET['update'])) {
	$proj_id = $_GET['update'];
	//$user_id = $_POST['user_id'];
	$task_id = $_POST['task_id'];

	$get_task_info_query = mysqli_query($connection, "SELECT assign_task.task, assign_task.assigned_date, assign_task.start_date, assign_task.completion_date, assign_task.status, users.firstName, users.lastName  FROM assign_task INNER JOIN users ON assign_task.user_id = users.user_id WHERE assign_task.project_id = '{$proj_id}' AND assign_task.id = '{$task_id}'");
	if (!$get_task_info_query) {
		echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);
	}
	else{
		while($info_row = mysqli_fetch_assoc($get_task_info_query)){
			$assignee_name = $info_row['firstName'] . " " . $info_row['lastName'];
			$task = $info_row['task'];
			$task_assigned_date = $info_row['assigned_date'];
			$task_start_date = $info_row['start_date'];
			$task_completion_date = $info_row['completion_date'];
			$task_status = $info_row['status'];	
	}

		header('Content-Type: application/json');
		echo json_encode(['status'=>1, 'msg'=>"Success", 'assigneeName'=>$assignee_name, 'Task'=>$task,'task_assigned_date'=>date('jS F Y', strtotime($task_assigned_date)), 'task_start_date'=>date('jS F Y', strtotime($task_start_date)), 'task_completion_date'=>date('jS F Y', strtotime($task_completion_date)), 'task_status'=>$task_status]);

	}
}


?>