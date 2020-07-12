<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

//GET USER ID WITH SESSION
$sess_user_id = $_SESSION['user_id'];
//POST DATA
$search_text = $_POST['search_text'];

$search = "SELECT projects.project_id ,
				projects.project_title  
				FROM projects
				INNER JOIN project_members ON projects.project_id = project_members.project_id
				WHERE projects.project_title LIKE '%$search_text%' AND project_members.user_id = '{$sess_user_id}'";


$search_query = mysqli_query($connection, $search);

if (mysqli_num_rows($search_query) > 0 ) {
	while ($row = mysqli_fetch_assoc($search_query)) {
		$project_id = $row['project_id'];
		$search_result = $row['project_title'];

		//$output = "<div>";
		$output = "<a id='project_" . $project_id . "' href='ongoing_projects_rebrand.php?update=" . $project_id . "' class=''>";
		// $output .= "<p class='proj_title_txt'>" . $search_result . "</p></a></div>";
		$output .= "<p class='proj_title_txt'>" . $search_result . "</p></a>";
		echo $output;
	}
} else{
	echo "<div class= 'project_lists'><p class= 'pt-2'>Nothing found</p></div>";
}

	
?>