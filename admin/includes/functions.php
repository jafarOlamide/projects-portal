<?php 
function get_project_id_update(){
	global $connection;
	if (isset($_GET['update'])) {
        $proj_id = $_GET['update'];
        
        $query = "SELECT * FROM projects WHERE project_id = {$proj_id}";
        $select_proj_id = mysqli_query($connection, $query);
        $projects_row = mysqli_fetch_assoc($select_proj_id);
        echo "<p class='proj_title_txt'>" . $projects_row['project_title'] . "</p>"; 
        }
}

function updateProject(){
    global $connection;
    if (isset($_GET['update'])) {
      $proj_id = $_GET['update'];
      
      $query = "SELECT * FROM projects WHERE project_id = $proj_id";
      $select_proj_id = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($select_proj_id)) {
         $project_id = $row['project_id'];
         $proj_added_by = $_SESSION['firstName'] ." " . $_SESSION['lastName'];
         $proj_date_updated = date("Y-m-d H:i:s");
      }
     
      if (isset($_POST['update_project'])) {
        $update_input = $_POST['update_input'];
        $date_added = date("Y-m-d H:i:s");
        $added_by = $_SESSION['firstName'] ." " . $_SESSION['lastName'];

        $insert_update = "INSERT INTO projects_update(
                          project_id,
                          update_text,
                          date_added,
                          updated_by
                        ) VALUES(
                          '$project_id',
                          '$update_input',
                          '$date_added',
                          '$added_by'
                        )";
        $insert_update_query = mysqli_query($connection, $insert_update);
        if (!$insert_update_query) {
          die("Query Update Failed: " . mysqli_error($connection));
        }
    }
  }
}

//DISPLAY UPDATE INPUTED 
function display_updates(){
	global $connection;
	if (isset($_GET['update'])) {
                            
      $proj_id = $_GET['update'];
      $display_updates = "SELECT * FROM projects_update WHERE project_id = $proj_id";

      $display_updates_query = mysqli_query($connection,$display_updates);
      if (!$display_updates_query) {
         die("Update Display Query Failed: " . mysqli_error($connection));
      }

      while ($row = mysqli_fetch_assoc($display_updates_query)) {
        $inserted_update = $row['update_text'];
        $project_updated_by = $row['updated_by'];

        if ($project_updated_by == $_SESSION['firstName'] ." " . $_SESSION['lastName']) {
          $project_updated_by = "You";
        }

        $projected_date_updated = $row['date_added'];
        $update_id = $row['id'];
        $project_updated_time = date("H:i", strtotime($projected_date_updated));
        $project_updated_date = date("d-m-Y", strtotime($projected_date_updated));

    	echo "<li class='updates_elem'>" . "<div class='user-icon-div'><small class='updated_by'><p class='user-icon'>" . $project_updated_by .  "</p></small><small class='ml-auto' id='del-div'><button class='delUpdBtn' name='" . $update_id . "'><img class='arrow-down-icon' src='img/recycling-bin-black.svg'></button></small></div>" . $inserted_update  . "<div class=' date_div'><small class='updates_date margin-auto'>" . $project_updated_date ."</small>". "<small class='updates_time ml-auto'>" . $project_updated_time ."</small></div></li>"; 
   		}
	}     
}

//DISPLAY MEMBERS ASSIGNED TASK TO
function displayAssignedTasks(){
  global $connection;
  if (isset($_GET['update'])) {
    $proj_id = $_GET['update'];

    $query_ass = "SELECT * FROM assign_task INNER JOIN users on `users`.`user_id` = `assign_task`.`user_id` WHERE project_id = $proj_id ORDER BY id DESC";
    $display_assigned_tasks = mysqli_query($connection, $query_ass);
    if (mysqli_num_rows($display_assigned_tasks) > 0 ) {
        if(!$display_assigned_tasks){
          die("Database conneciton failed: " . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_assoc($display_assigned_tasks)) {
          $assign_task_id = $row ['id'];
          $assigned_to = $row['firstName'] . " " . $row['lastName'];
          $assigned_task = $row['task'];
          $assigned_date = $row['assigned_date'];
          $start_date = $row['start_date'];
          $completion_date = $row['completion_date'];
          $task_status = $row['status'];

          if ($task_status == "Incomplete") {
            echo "<li class='assign_li'><a href='#' id='" . $assign_task_id . "' style='color: black;'>" . $assigned_task . "</a></li>";
          } elseif ($task_status == "Completed") {
            echo "<li class='assign_li'><a href='#' id='" . $assign_task_id . "' style='color: black;'>" . $assigned_task . "</a></li><button type='button' class='btn ml-auto' data-toggle='modal' name='". $assign_task_id ."'><img src='img/icons8-delete-thick.svg' class='icon-remove-mem' id='remove-member'></button>";
          }

          
        }
        
    } else{
        echo "<li id='no-task'>No Task Assigned</li>";
    }
    
  }
}

//DISPLAY ALL USERS IN THE SELECT OPTION
function displayAllUsers(){
  global $connection;
  $users_query = "SELECT * FROM users ORDER BY firstName ASC";
  $display_users = mysqli_query($connection, $users_query);

  while ($row = mysqli_fetch_assoc($display_users)) {
     $user_id = $row['user_id'];
     $user_fname = $row['firstName'];
     $user_lname = $row['lastName'];

     $user_name = $user_fname . " " . $user_lname;

     echo "<option value='" . $user_id . "'>" . $user_name . "</option>"; 
   } 
}

//DISPLAY PROJECT MEMBERS
function displayProjectMembers(){
  global $connection;
  if (isset($_GET['update'])) {
    $proj_id = $_GET['update'];

    $query_member = "SELECT * FROM project_members 
                      INNER JOIN users ON `users`.`user_id` = `project_members`.`user_id` 
                      INNER JOIN projects ON `projects`.`project_id` = `project_members`.`project_id` 
                      WHERE `project_members`.`project_id` = $proj_id 
                      ORDER BY  member_id DESC";
    $display_member_query = mysqli_query($connection, $query_member);
    if (mysqli_num_rows($display_member_query) > 0 ) {
        if(!$display_member_query){
          die("Database connecton failed: " . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_assoc($display_member_query)) {
          $member_name = $row['firstName'] . " " . $row['lastName'];
          $member_id = $row['member_id'];
          $project_creator = $row['created_by'];
          $member_role = $row['member_role'];
          if ($member_role == 'admin') {
            // $member_role = "Project Admin";
            echo "<li class='member_li' id='tryLi'><div class='row'>" . $member_name . "<button type='button' class='btn ml-auto rem_mem_btn' data-toggle='modal' data-target='#memberDeleteModal' name='". $member_id ."'><img src='img/icons8-delete-thick.svg' class='icon-remove-mem' id='remove-member'></button></div><div class ='row' id='adminSpan'>Project Admin</div></li>";
          } else{
            echo "<li class='member_li' id='tryLi'><div class='row'>" . $member_name . "<button type='button' class='btn ml-auto rem_mem_btn' data-toggle='modal' data-target='#memberDeleteModal' name='". $member_id ."'><img src='img/icons8-delete-thick.svg' class='icon-remove-mem' id='remove-member'></button></div></li>";
          }
          
        }        
    } else{
        echo "<li id='no-member'>No Member added to this Project</li>";
    }
    
  }  
}

//OPTION TO SELECT MEMBERS FOR TASK ASSIGNMENT
function selectMemberAssign(){
  global $connection;
  if (isset($_GET['update'])) {
    $proj_id = $_GET['update'];

    $query_member = "SELECT * FROM project_members INNER JOIN users ON `users`.`user_id` = `project_members`.`user_id` WHERE project_id = $proj_id ORDER BY member_id DESC";
    $display_member_query = mysqli_query($connection, $query_member);
    if (mysqli_num_rows($display_member_query) > 0 ) {
        if(!$display_member_query){
          die("Database connecton failed: " . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_assoc($display_member_query)) {
          $member_id = $row['member_id'];
          $user_id = $row['user_id'];
          $member_name = $row['firstName'] . " " . $row['lastName'];
          echo "<option value='" . $user_id . "'>" . $member_name . "</option>";
        }        
    } else{
        echo "<option id='no-member' value='no-member'>No Member added to this Project</option>";
    }
    
  }  
}
?>