<?php 
include_once "../admin/config/server.php";
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$user_role = "user";
$password = $first_name. "1234";
if (isset($first_name) && isset($last_name) && isset($email)) {
	$add_query = "INSERT INTO users (
				  firstName,
				  lastName,
				  email,
				  user_role,
				  password
				  ) 
				  VALUES (
				  '$first_name',
				  '$last_name',
				  '$email',
				  '$user_role',
				  '$password'
					)";
	$add_user = mysqli_query($connection, $add_query);
	$full_name = $first_name ." " .$last_name;
	$new_user_id = mysqli_insert_id($connection);
	header('Content-Type: application/json');

	if (!$add_user) {
		echo json_encode(['status'=>0, 'msg'=>"Database query failed: " .mysqli_error($connection)]);
	}
	else{
		echo json_encode(['status'=>1, 'msg'=>"Success", 'full_name'=>$full_name, 'email'=>$email, 'uid'=>$new_user_id]);
	}
}
else{
	echo "Input Fields Empty";
}
?>