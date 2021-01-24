<?php 
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require '../PHPMailer/src/Exception.php';
// require '../PHPMailer/src/PHPMailer.php';
// require '../PHPMailer/src/SMTP.php';

if (isset($_GET['update'])) {
	 $project_id = $_GET['update'];
	 $user_id = $_POST['user_id'];
	 $pAssignee_task = $_POST['assignee_task'];
	 $assignee_task = mysqli_escape_string($connection, $pAssignee_task);
	 $date_start = $_POST['date_start'];
	 $date_assigned = (new DateTime())->format('Y-m-d H:i:s');
	 $feed_back_date = $_POST['feedback_date'];

$query = "INSERT INTO assign_task(
		  project_id,
		  user_id,
		  task,
		  assigned_date,
		  start_date,
		  completion_date
		  )
		 VALUES (
		 '$project_id',
		 '$user_id',
		 '$assignee_task',
		 '$date_assigned',
		 '$date_start',
		 '$feed_back_date'
		)";

$assign_query = mysqli_query($connection, $query);
header('Content-Type: application/json');
	        
	        if (!$assign_query) {
	        	echo json_encode(['status'=>0, 'msg'=> "Unable to assign task: " . mysqli_error($connection)]);
	        }

	        else{



	        	//GET LATEST PROJECT ID
	        	$new_id = mysqli_insert_id($connection);
				echo json_encode(['queryStatus'=>1, 'queryMsg'=>"Success",'mailStatus'=>1, 'mailMsg'=>'Message has been sent', 'new_id'=>$new_id]);

	        	// //SEND MAIL TO TASK ASSIGNEE
	        	// $mail = new PHPMailer(true);  // Passing `true` enables exceptions
	        	// //SELECT USER DETAILS
	        	// $sel_query = mysqli_query($connection, "SELECT * FROM users WHERE user_id = {$user_id}");

	        	// while ($row = mysqli_fetch_assoc($sel_query)) {
	        	// 	$user_email = $row['email'];
	        	// }
				// try {
				//     //Server settings
				//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
				//     $mail->isSMTP();                                      // Set mailer to use SMTP
				//     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
				//     $mail->Username = '';                 // SMTP username
				//     $mail->Password = '';                           // SMTP password
				//     $mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
				//     $mail->Port = '';                                    // TCP port to connect to

				//     //Recipients
				//     $mail->setFrom('xyz@gmail.com');
				//     $mail->addAddress($user_email);     // Add a recipient
				//     $mail->addCC('abcd@gmail.com');

				//     $mail_body = "Your Task: " . $assignee_task . "</br> " .
				//     			 "Date Assigned: " . $date_assigned . "</br> " .
				//     			 "Expected Feedback Date:" . $feed_back_date;
				//     //Content
				//     $mail->isHTML(true);                                  // Set email format to HTML
				//     $mail->Subject = 'Task Asignment from IT Project Portal';
				//     $mail->Body    =  strip_tags($mail_body);
				//     $mail->AltBody = strip_tags($mail_body);

				//     $mail->send();
				//     // echo $user_id;
				// 	//echo '</br>Message has been sent';
				// 	echo json_encode(['queryStatus'=>1, 'queryMsg'=>"Success",'mailStatus'=>1, 'mailMsg'=>'Message has been sent', 'new_id'=>$new_id]);
				// } catch (Exception $e) {
				// 	//echo '</br>Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				// 	echo json_encode(['queryStatus'=>1, 'queryMsg'=>"Success", 'mailStatus'=>0, 'mailMsg'=>'Message could not be sent. Mailer Error: ', $mail->ErrorInfo]);
				// }

	        }
}

?>
