<?php 

include "../server.php";
	function updateProject(){
		global $connection;

		if (isset($_GET['update'])) {
		    $project_id = $_GET['update']; 
			$pupdate_text = $_POST['updInput'];
			$update_text = mysqli_real_escape_string($connection, $pupdate_text);
			$update_date = (new DateTime())->format('Y-m-d H:i:s');
			$updated_by = $_POST['prAddBy'];

			$insert_update = "INSERT INTO projects_update(
                              project_id,
                              update_text,
                              date_added,
                              updated_by
                            ) VALUES(
                              '$project_id',
                              '$update_text',
                              '$update_date',
                              '$updated_by'
                            )";
	        $insert_update_query = mysqli_query($connection, $insert_update);

	        $update_id = mysql_insert_id($connection);

        	header('Content-Type: application/json');
	        
	        if (!$insert_update_query) {
	        	echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);
	        }

	        else{
	        	echo json_encode(['status'=>1, 'msg'=>"Success", 'dateAdded'=>date('d-m-Y', strtotime($update_date)), 'updateId'=>$update_id, 'timeAdded'=>date('H:i', strtotime($update_date))]);
	        }

	        //DISPLAY UPDATES
		    }
	}

	updateProject();
?>