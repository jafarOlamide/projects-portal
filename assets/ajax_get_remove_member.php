<?php 
include_once "../admin/config/server.php";
if (isset($_GET['update'])) {
	$project_id = $_GET['update'];
    $member_id = $_POST['member_id'];
    
    $mem_query = "SELECT `users`.`firstName`, `users`.`lastName`
                FROM project_members 
                INNER JOIN users ON `users`.`user_id` = `project_members`.`user_id` 
                INNER JOIN projects ON `projects`.`project_id` = `project_members`.`project_id` 
                WHERE `project_members`.`project_id` = {$project_id} AND member_id = {$member_id}";

    $member_query = mysqli_query($connection, $mem_query);
    header('Content-Type: application/json');

    if (!$member_query) {
        echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);  
    }
    else {
        while ($row = mysqli_fetch_assoc($member_query)) {
            $full_name = $row['firstName']. " " . $row['lastName'];
        }
        echo json_encode(['status'=>1, 'msg'=>"Success", 'memName'=>$full_name]);
    }
		
}

?>