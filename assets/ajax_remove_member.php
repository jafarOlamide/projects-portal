<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

?>
<?php 
if (isset($_GET['update'])) {
	$project_id = $_GET['update'];
	$member_id = $_POST['member_id'];

	if ($project_id !== "" && $member_id !== "") {

		$sel_query = "DELETE FROM project_members WHERE project_id = {$project_id} AND member_id = {$member_id}";
		$check_query = mysqli_query($connection, $sel_query);
		header('Content-Type: application/json');
	        
        if (!$check_query) {
        	echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);
        }

        else{
        	echo json_encode(['status'=>1, 'msg'=>"Success"]);
        }
	} else{
		header('Content-Type: application/json');
		$error_mess = "<p>No User ID found</p>";
		echo json_encode(['err_status'=> 1, 'err_msg'=>$error_mess]);
	}
}

?>