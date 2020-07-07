<?php
include_once "../admin/config/server.php";
//GET USER ID WITH SESSION
$sess_user_id = $_SESSION['user_id'];
//POST DATA
$search_text = $_POST['searchText'];
$name_search = explode(" ", $search_text);

if (count($name_search) == 2 ) {
	$search = "SELECT user_id, firstName, lastName, email FROM users 
				WHERE (firstName LIKE '%$name_search[0]%' AND lastName LIKE '%$name_search[1]%') AND  user_role = 'admin' ORDER BY firstName ASC";
} //elseif (count($name_search) == 1) {
	else {
	$search = "SELECT user_id, firstName, lastName, email FROM users 
				WHERE (firstName LIKE '%$name_search[0]%' OR lastName LIKE '%$name_search[0]%') AND user_role = 'admin' ORDER BY firstName ASC";
}

$search_query = mysqli_query($connection, $search);
if (!$search_query) {
	die("Database query failed: " . mysqli_error($connection));
} else{
	if (mysqli_num_rows($search_query) > 0 ) {
				 //$output = "<tr><th id='user_sel'></th><th>Name</th><th>Email</th><th>Status</th></tr>";

	while ($row = mysqli_fetch_assoc($search_query)) {
		$user_id = $row['user_id'];
		$search_result = $row['firstName'] . " " . $row['lastName'];
		$user_email = $row['email'];
		$output = "<tr id='tr_" . $user_id . "'><td><input type='checkbox' name='" . $user_id . "'></td><td>" . $search_result . "</td><td>" . $user_email . "</td><td class='editTd'><button class='btn editAdminBtn' name='" . $user_id . "' data-toggle='modal' data-target='#editAdminModal'><img src='img/edit.svg' class='editImg'></button></td></tr>";
		echo $output;
	}
	} else{
		echo "<tr class= 'project_lists'><td></td><td class= 'pt-2'>Nothing found</td></td><td></tr>";
	}
}
	



?>


	   