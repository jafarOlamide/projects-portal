<?php 
include_once "../admin/config/server.php";
$proj_id = $_POST['proj_id'];

$update_query = mysqli_query($connection, "UPDATE projects SET status = 'Pending'
									WHERE project_id = '{$proj_id}'"
									);
header('Content-Type: application/json');
if (!$update_query) {
	echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]); 
} else {
	echo json_encode(['status'=>1, 'msg'=>"Success"]);
}

?>