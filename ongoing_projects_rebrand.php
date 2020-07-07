<!-- SHOW CATEGORY -->
<?php
include "server.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
}
?>
<?php include 'includes/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Ongoing Projects</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include 'includes/headLinks.php';
      $sess_user_email = $_SESSION['user_id'];
      $query_user_session = mysqli_query($connection, "SELECT * FROM users WHERE user_id = '{$sess_user_email}'");
      if (!$query_user_session) {
        die("Query Failed:" . mysqli_error($connection));
      }
      while ($row = mysqli_fetch_assoc($query_user_session)) {
        $sess_user_id = $row['user_id'];
      }
      
    ?>
</head>
<body>    
   <div id="wrapper-major">   
    <div class="row nopadding">

              <!-----------------------PROJECT LIST DIV--------------------------->
            <div class="container col-3 nopadding" id="projs_div">
                  <div class="container" id="project_list_header">
                      <div class="row container mb-3">
                        <div>
                          <button type="submit" id="option-icon"><i><img src="img/menu-3.svg" class="" style=" height: 22px;"></i></button>
                        </div>
                        <div class="pl-2">
                          <h5 style="font-size: 22px;">Projects</h5>
                        </div>                        
                        <div id="option-select">
                          <ul class="nopadding">
                            <a id="closesideBar">&times;</a>
                            <li class="option-li"><a href="dashboard.php">Dashboard</a></li>
                            <?php if ($_SESSION['user_role'] == 'admin') {
                              echo '<li class="option-li"><a href="test_all_projects.php">All Projects</a></li>';
                            } ?>
                            <?php if ($_SESSION['user_role'] == 'admin') {
                              echo '<li class="option-li"><a href="createProject.php">Add Project</a></li>';
                            } ?>
                            <?php 
                              if ($_SESSION['user_role'] == 'admin') {
                                echo '<li class="option-li"><a href="completed_projects.php">Completed Projects</a></li>';
                              } else{
                                echo '<li class="option-li"><a href="member_completed_projects.php">Completed Projects</a></li>';
                              }
                            ?>
                            <li class="option-li"><a href="includes/logout.php">Log Out</a></li>
                          </ul>
                        </div>
                      </div>                       
           <!-------  SEARCH FORM -------->
            <div id="search_pane">
              <form class="form-group search-example" action="search.php" method="post" autocomplete="off">
                <input type="text" name="search_input" placeholder="Search Projects" class="form-control" id="search_panel">
                 <button type="submit" name="search_button"><i><img src="img/if_icon-111-search_314478.svg" class="" style="font-size: 10px;"></i></button>
              </form>
            </div>
            <div class="search_results"></div>
            <!-------  SEARCH FORM -------->
            </div>
              <div id="projectlist_div" class="container">
                 <?php
                    //SELECT PROJECT DETAILS
                  $query =  "SELECT 
                                project_members.member_id,
                                project_members.project_id,
                                project_members.member_role,
                                projects.project_title,
                                projects.project_owner,
                                projects.start_date,
                                projects.due_date,
                                projects.stakeholders,
                                projects.description,
                                projects.date_created,
                                projects.created_by,
                                users.firstName,
                                users.lastName,
                                users.email,
                                users.user_role
                                FROM project_members
                                LEFT JOIN projects ON projects.project_id = project_members.project_id
                                LEFT JOIN users ON project_members.user_id = users.user_id
                                LEFT JOIN projects_update ON projects_update.project_id = projects.project_id
                                WHERE project_members.user_id = '{$sess_user_id}'
                                AND projects.status = 'Ongoing'
                                GROUP BY projects.project_id
                                ORDER BY max(projects_update.date_added) DESC";

                    $project_details_query = mysqli_query($connection, $query);
                    if(!$project_details_query){
                        die("Database conneciton failed: " . mysqli_error($connection));
                    }  
                    while ($row = mysqli_fetch_assoc($project_details_query)) { 
                    
                    $project_id = $row['project_id'];
                    $proj_member_role = $row['member_role'];
                   ?>
                   <div class="project_lists">
                    <a href="ongoing_projects_rebrand.php?update=<?php echo $project_id; ?>" class="project_links">
                      <p class="proj_title_txt"><?php echo $row['project_title']; ?></p>
                    </a>
                   </div>
                 <?php } ?> 
              </div>
            </div>
<!-----------------------PROJECT LIST DIV--------------------------->
         
<!--   UPDATES DIV -->         
<?php 
  if (isset($_GET['update'])) {
    ?>
              <div class="col-6 nopadding" id="update_div">
                    <div id="update_div_header" class="container">
                        <div class="row container" style="padding-left: 10px;">
                            <?php 
                            get_project_id_update();
                            ?>
                           <div class="ml-auto row">
                            <?php 
                              if ($proj_member_role == 'admin') {
                                echo '<div class="mr-3 "><a class="mem-li" href="edit_project.php?edit=<?=$project_id?>"><img src="img/edit-bl.svg" class="opt-ico" style="width: 22px; height: 22px;"></a></div>';
                              }
                            ?>
                              <?php 
                              if ($proj_member_role == 'admin') {
                                echo '<div class="mr-3 "><button class="opt-ico"id="pendprojectbtn" name="<?php echo $project_id; ?>"><img src="img/push-pin.svg" style="width: 22px; height: 22px;"></button></div>';
                              }
                            ?>
                            <?php 
                              if ($proj_member_role == 'admin') {
                                echo '<div class="mr-3 "><button class="opt-ico"id="closeprojectbtn" name="<?php echo $project_id; ?>"><img src="img/icons8-delete-thick.svg" style="width: 22px; height: 22px;"></button></div>';
                              }
                            ?>  
                              <!-- <div class=""><button class="opt-ico"id="closeprojectbtn" name="<?php //echo $project_id; ?>"><img src="img/recycling-bin-black.svg" style="width: 22px; height: 22px;"></button></div>  -->  
                            </div>
                        </div>
                    </div>
                    <div id='update_inputs_div'>
                       <ul id='updates-ul'>
                      <!--  DISPLAY UPDATES --> 
                      <?php display_updates(); ?>
                      </ul>
                    </div>
                    
                       <?php  
                       //UPDATE PROJECT
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
                        ?>             
        <div>
          <form action="" method="post" id="update_form" autocomplete="off">
          <div id="submit_update_div" class="row">
            <div class="col-auto pr-0 upd" style="width: 90%;">
             <textarea name="update_input" placeholder="Add Update" id="update_input" class="form-control block form-control-no-border entry"></textarea>
            </div>
            <div style="display: none;">
              <input id="pr_d_updated" type="text" name="update_project_date_updated" value="<?php if(isset($proj_date_updated)) {echo $proj_date_updated;}?>">
            </div>
            <div style="display: none;">
              <input type="text" id="pr_added_by" name="projects_updated_by" value="<?php if(isset($proj_added_by)) echo $proj_added_by; ?>">
            </div>
            <div class="col-auto pl-1 d-none d-xl-block" style="width: 10%;">
              <span><button class="btn" id="update_btn" name="update_project" type="submit">Update</button></span>
            </div>
            </div>
          </form>
        </div>
         </div>

         <!-----------------------UPDATES DIV--------------------------->

         <!-----------------------
                PROJECT INFO DIV
          --------------------------->
         <div class="col-3" id="info_div">
             <?php  $fetch_proj_info = mysqli_query($connection, $query);
                        $proj_title_query = mysqli_fetch_assoc($fetch_proj_info);
                        
                        $proj_id = $proj_title_query['project_id'];
                        $proj_title = $proj_title_query['project_title'];
                        $proj_owner = $proj_title_query['project_owner'];
                        $proj_head = $proj_title_query['project_head'];
                        $proj_created_by = $proj_title_query['created_by'];
                        $project_date_created = $proj_title_query['date_created'];
                        $proj_start_date = $proj_title_query['start_date'];
                        $proj_due_date = $proj_title_query['due_date'];
                        $proj_description = $proj_title_query['description'];   
                  ?>
                  <div id="info_header" class="container row">
                    <h5 class="proj_title_txt">Project Information</h5>
                    <!-- <div class="ml-auto row"> -->
                      <!-- <div class="mr-2 opt-ico"><a class="mem-li" href="edit_project.php?edit=<?=$project_id?>"><img src="img/edit-bl.svg" style="width: 22px; height: 22px;"></a></div>
                      <div class="mr-2 opt-ico"><button id="pendprojectbtn" name="<?php //echo $project_id; ?>"><img src="img/push-pin.svg" style="width: 22px; height: 22px;"></button></div>
                      <div class="mr-2 opt-ico"><button id="closeprojectbtn" name="<?php //echo $project_id; ?>"><img src="img/icons8-delete-thick.svg" style="width: 22px; height: 22px;"></button></div> -->
                      <!-- <div class="mr-2"><button class="opt-ico" id="deleteprojectbtn" name="<?php //echo $project_id; ?>"><img src="img/recycling-bin-black.svg" style="width: 22px; height: 22px;"></button></div>
                      <div><button type="submit" class="opt-ico" id="projinfo-icon"><i><img src="img/menu-3.svg" class="" style=" height: 22px;"></i></button></div> -->
                    <!-- </div> -->
                  </div>
                  <!----Add Member Modal -->
                  <div id="addMemberModal" class="ass-modal">
                      <!-- Modal content -->
                      <div class="ass-modal-content">
                        <div class="ass-modal-header">
                          <span class="ass-close">&times;</span>
                          <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
                        </div>
                        <hr>
                        <div class="ass-modal-body" style="margin-bottom: -12px;">
                          <div class="form-group">
                            <div class="ass-errorMesss" style="display: none;"></div>
                            <div class="assignProgress">
                                <i class="fa fa-spinner fa-spin" id="spinnerAddMem"></i>
                                <label id="spinnerAddMemLabel">Adding....</label>
                            </div>
                            <div class="row">
                              <div class="col-8">
                                <label>Name</label>
                                <div>
                                    <select class="custom-select" name="memberName'" id="member-name">
                                      <option class="dropdown-item">Select...</option>
                                      <?php displayAllUsers(); ?>
                                    </select>
                                </div>
                              </div>
                              <div class="col">
                                <label>Role</label>
                                <div>
                                    <select class="custom-select" name="memberRole'" id="member-role">
                                      <option class="dropdown-item">Select...</option>
                                      <option class="dropdown-item" value="admin">Admin</option>
                                      <option class="dropdown-item" value="member">Member</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="ass-modal-footer">
                          <button class="btn btn-sm btn-primary" name="addMember" id="add-member">Add</button> 
                        </div>
                      </div>
                  </div>
             <div id="proj_info_fields">     
               <div class="info_field_a container">
                  <p>Owner &#58; <?php echo $proj_owner; ?> </p>
                 <p style="text-transform: capitalize;">Created <?php echo date("jS F Y", strtotime($project_date_created)) . " <span style=\"text-transform: lowercase;\" > at </span> " . date("g:iA", strtotime($project_date_created)) . "<span style=\"text-transform: lowercase;\" > by </span> " . $proj_created_by; ?> </p>
                  <p>Project Head: <?php echo $proj_head; ?></p>
                  <p>Start Date &#58; <?php echo date("jS F Y",strtotime($proj_start_date)); ?></p>
                  <p>Due Date &#58; <?php echo date("jS F Y",strtotime($proj_due_date));?></p>
               </div>
               <!-- <img src=img/arrow-down-sign-to-navigate.svg> -->
               <div class="info_desc container">
                  <h4>Description</h4>
                  <p><?php echo $proj_description; ?></p>
               </div>
               <!-- Assigned Tasks -->
               <div id="info_assign">
                 <div>
                    <div class="container row pb-2">
                      <h4 class="">Assigned Tasks</h4> 
                      <?php 
                        if ($proj_member_role == 'admin') {
                          echo '<button type="button" class="btn ml-auto" data-toggle="modal" data-target="#exampleModalCenter" id="assign-plus-btn">
                      <i class="assign-plus">+</i>
                      </button>';
                        }
                       ?>                     
                    </div>
                    <!-- ASSIGN TASK Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Assign Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal-close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <!-- MODAL BODY -->
                              <div>
                                <div class="container">
                                  <div class="mem-errorMesss" style="display: none;"></div>
                                  <div class="assignSpinner">
                                    <i class="fa fa-spinner fa-spin" id="spinnerAss"></i>
                                    <label id="assSpinnerLabel">Assigning.....</label>
                                  </div>
                                  <form id="submit_assign">
                                    <div class="form-group">
                                      <label>Name</label>
                                      <div>
                                          <select class="custom-select" id="assignee_Name" name="assignee_name">
                                            <option>Choose...</option>
                                            <?php selectMemberAssign(); ?>
                                          </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label>Task</label>
                                      <div>
                                          <textarea class="form-control" name="assignee_task" id="Assignee_Task"></textarea>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-auto">
                                      <label>Start Date</label>
                                      <div class="col-sm-12 row">
                                          <input type="date" name="pdate_assigned" style="width: auto;" class="form-control" id="start_date">
                                      </div>
                                      </div>
                                      <div class="form-group col-auto">
                                        <label>End Date</label>
                                        <div class="col-sm-12 row">
                                            <input type="date" name="p_feedback_date" style="width: auto;" class="form-control" id="pFeedBackDate">
                                        </div>
                                      </div>
                                    </div>
                                    <hr>
                                    <div class="footer">
                                      <button class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                      <button class="btn btn-sm btn-primary" name="assign_project" id="assign_project_btn">Assign</button>
                                    </div>
                                  </form> 
                                </div>
                              </div>
                              <!-- MODAL BODY -->
                          </div>
                        </div>
                      </div>
                      <!-- Modal -->
                    </div>
                 </div>
                 <div>
                    <ul class="nopadding" id="assigned-ul">
                       <?php 
                         //displayAssignedTasks();
                         if (isset($_GET['update'])) {
                            $proj_id = $_GET['update'];

                            $query_ass = "SELECT * FROM assign_task WHERE project_id = $proj_id ORDER BY id DESC";
                            $display_assigned_tasks = mysqli_query($connection, $query_ass);
                            if (mysqli_num_rows($display_assigned_tasks) > 0 ) {
                                if(!$display_assigned_tasks){
                                  die("Database conneciton failed: " . mysqli_error($connection));
                                }
                                while ($row = mysqli_fetch_assoc($display_assigned_tasks)) {
                                  $assign_task_id = $row ['id'];
                                  $assigned_task = $row['task'];
                                  $assigned_date = $row['assigned_date'];
                                  $start_date = $row['start_date'];
                                  $completion_date = $row['completion_date'];
                                  $task_status = $row['status'];

                                  echo "<li class='assign_li' name='" . $assign_task_id . "' id='link-task'><a href='#' style='color: black;'>" . $assigned_task . "</a></li>";
                                   }
                                
                            } else{
                                echo "<li id='no-task'>No Task Assigned</li>";
                            }
                            
                          }
                      ?>
                  </ul>
                   <!-- The Assigned Task Modal -->
                    <div id="asignTaskModal" class="ass-modal">
                      <!-- Modal content -->
                      <div class="ass-modal-content">
                        <div class="ass-modal-header">
                          <span class="ass-close">&times;</span>
                          <h4 class="modal-title text-center" id="assignee-name"></h4>
                        </div>
                        <hr>
                        <div class="ass-modal-body">
                          <div class="ass-first-page ">
                              <div class="center">
                                <h6 class="text-center ass-labels">Task</h6>
                                <p class="task_details" id="task-details"></p>
                              </div>
                              <div class="center">
                                <h5 class="text-center ass-labels">Date Assigned</h5>
                                <p class="date-details" id="assigned-date"></p>
                              </div>
                              <div class="center">
                                <h6 class="text-center ass-labels">Start Date</h6>
                                <p class="date-details" id="start-date"></p>
                              </div>
                              <div class="center">
                                <h6 class="text-center ass-labels">Expected Completion Date</h6>
                                <p class="date-details" id="end-date"></p>
                              </div>
                              <hr>
                              <div class="ass-modal-footer">
                                <div class="center"> 
                                  <button class="btn btn-success dir-btn" id="next-button"><img src="img/right-arrow.svg"class="button-img"></button>
                                </div>
                              </div>
                          </div>
                          <div class="ass-next-page">
                            <div class="center">
                              <h6 class="text-center ass-labels">Task Status</h6>
                              <p id="task-status"></p>
                            </div>
                            <hr>
                            <div class="" id="finish-div">
                                <label class="comp-label">Click To Finish Task</label>
                                <button id="task_completed_btn" class="btn btn-primary btn-block">Finish Task</button>
                            </div>
                            <hr>
                            <div class="ass-modal-footer">
                              <div class="center">
                                  <button id="back-button" class="btn btn-sm btn-success dir-btn"><img src="img/right-arrow.svg" id="back-button-img" class="button-img"></button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- //The Assigned Task Modal -->
                 </div>
               </div>
               <!-- Project Members -->
               <div id="proj-members">
                  <div>
                    <div class="container row pb-3">
                      <h4 class="">Project Members</h4> 
                      <?php 
                        if ($proj_member_role == 'admin') {
                          echo '<button type="button" class="btn ml-auto" id="add-plus-btn">
                      <i class="assign-plus">+</i>
                      </button>';
                        }
                       ?>                       
                    </div>
                    <ul class="nopadding" id="member-ul">
                       <?php 
                         displayProjectMembers();
                      ?>
                  </ul>
                  <!-- Remove Member Modal -->
                    <div class="modal fade" id="memberDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title text-center" id="removeMemberWarn">WARNING</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            
                          </div>
                          <div class="modal-body">
                            <div class="removeSpinner">
                              <i class="fa fa-spinner fa-spin" id="spinnerRem"></i>
                              <label id="spinnerLabel"></label>
                            </div>
                            <h6>Are you sure you want to remove<span id="warnMessage"></span>from this project</h6>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-sm" id="confirmRemoveMember">Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Remove Member Modal -->
                 </div>
               </div>
             </div>
         </div>
         <!-----------------------PROJECT INFO DIV ---------------------------> 
          <?php } ?>                
     </div>
  </div>  

<?php include "includes/footerLinks.php"?>   
</body>
<script type="text/javascript">
  $(document).ready(function(){
    //SEARCH ALL PROJECTS
      $('#search_panel').keyup(function(){
        var searchInput = $('#search_panel').val();
        //AJAX PROCESS TO SUBMIT
        $.ajax({
          method: "POST",
          url: "assets/ajax_search.php?<?=$project_id?>",
          data: {'searchText': searchInput},
          success: function(searchRes){
                      $('#projectlist_div').html(searchRes);
                    }
        });
      });
      //close project
      $("#closeprojectbtn").click(function(){
        var projectID = $("#closeprojectbtn").attr("name");
        if (confirm("Are you sure you want to close this project, this cannot be undone!")) {
                    $.ajax({
                              type: "POST",
                              url: "assets/ajax_close_project.php",
                              data: {
                                      'proj_id': projectID
                                    },
                              success: function(res){
                                if (res.status == 1) {
                                    //location = "ongoing_projects_rebrand.php";
                                }
                              }
                            });
        } else {
          return false;
        }
      });

      //DELETE UPDATE
      $('#updates-ul').on('click', '.delUpdBtn', function(e){
      var projectMemberId = $(this).attr("name");
      $.ajax({
              type: "POST",
              url: "assets/ajax_delete_update.php?update=<?=$project_id?>",
              data: {
                       'member_id': projectMemberId    
                    },
              success: function(removedRes){
                        if (removedRes.status == 1) {
                          var memberName = removedRes.memName;
                          var spinMessage = "Removing "+memberName;
                          $('#spinnerLabel').html(spinMessage);
                           $("#warnMessage").css('color','red');
                           var warningMessage = " "+memberName+" ";
                           $("#warnMessage").html(warningMessage);
                        }
                      }
          });
      });

      //PEND PROJECT
      $("#pendprojectbtn").click(function(){
         var projectID = $("#pendprojectbtn").attr("name");
        if (confirm("ARE YOU SURE YOU WANT TO PEND THIS PROJECT")) {
                    $.ajax({
                              type: "POST",
                              url: "assets/ajax_pend_project.php",
                              data: {
                                      'proj_id': projectID
                                    },
                              success: function(res){
                                if (res.status == 1) {
                                    alert("Project Pended");
                                    location= "ongoing_projects_rebrand.php";
                                }
                              }
                            });
        } else {
          return false;
        }
      })

      //Delete Project
      $("#deleteprojectbtn").click(function(){
        var projectID = $("#deleteprojectbtn").attr("name");
        if (confirm("Are you sure you want to delete this project, this cannot be undone" +projectID)) {
                    $.ajax({
                              type: "POST",
                              url: "assets/ajax_delete_project.php",
                              data: {
                                      'proj_id': projectID
                                    },
                              success: function(res){
                                if (res.status == 1) {
                                    //location = "ongoing_projects_rebrand.php";
                                }
                              }
                            });
        } else {
          return false;
        }
      });
    //Sending Updates to the Server with enter key
    $('#update_input').keypress(function(e){
      if (e.keyCode === 13 && e.shiftKey === false) {
        var updateInput = $('#update_input').val();
        var prAddedBy = document.getElementById('pr_added_by').value;

        e.preventDefault();

        if (updateInput !== "") {
          $.ajax({
          type: "POST",
          url: "assets/ajax_submit.php?update=<?=$project_id?>",
          data: {
                  'updInput': updateInput,
                  'prAddBy': prAddedBy
                },
          success: function(res){
              if(res.status === 1){
                //remove text
                $('#update_input').val("");

                var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto' id='del-div'><button class='delUpdBtn' name='"+res.updateId+"'><img class='arrow-down-icon' src='img/recycling-bin-black.svg'></button></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

                //append text to UL
                $("#updates-ul").append(update);

                //scroll to bottom
                $('#update_inputs_div').scrollTop(1000000);
              }

              else{
                //do this
                console.log(res.msg);
              }              
          }
        });
      }
        e.preventDefault();
      }
    });

    //Sending Updates to the Server
    $("#update_btn").click(function(e){
      var updateInput = $('#update_input').val();
      var prAddedBy = document.getElementById('pr_added_by').value;

      e.preventDefault();
      if (updateInput !== "") {
          $.ajax({
          type: "POST",
          url: "assets/ajax_submit.php?update=<?=$project_id?>",
          data: {
                  'updInput': updateInput,
                  'prAddBy': prAddedBy
                },
          success: function(res){
              if(res.status === 1){
                //remove text
                $('#update_input').val("");

                var update = "<li class='updates_elem'><div class='user-icon-div'><small class='updated_by'><p class='user-icon'>You</p></small><small class='ml-auto' id='del-div'><button class='delUpdBtn' name='"+res.updateId+"'><img class='arrow-down-icon' src='img/recycling-bin-black.svg'></button></small></div>"+updateInput+"<div class='date_div'><small class='updates_date margin-auto'>"+res.dateAdded+"</small><small class='updates_time ml-auto'>"+res.timeAdded+"</small></div></li>";

                //append text to UL
                $("#updates-ul").append(update);

                //scroll to bottom
                $('#update_inputs_div').scrollTop(1000000);
              }

              else{
                //do this
                console.log(res.msg);
              }              
          }
        });
      }      
    });

    //ASSIGNING TASK TO PROJECT MEMBERS
    $("#assign_project_btn").click(function(e){
      var assigneeName = $("#assignee_Name option:selected").text(); 
      var userID = $("#assignee_Name").val();
      var assigneeTask = $("#Assignee_Task").val();
      var startDate = $("#start_date").val();
      var feedbackDate = $("#pFeedBackDate").val();

      e.preventDefault();
      if (assigneeName !== "" && assigneeTask !== "" && startDate !== "" && feedbackDate !== "") {
          $.ajax({
          type: "POST",
          url: "assets/ajax_assign_task.php?update=<?=$project_id?>",
          data: {
                  'user_id': userID,
                  'assignee_task': assigneeTask,
                  'date_start': startDate,
                  'feedback_date': feedbackDate
                },
          success: function(res2){  
                    $('.assignSpinner').show();
                      setTimeout(function(){  
                        $('#assSpinnerLabel').html("Sending Mail.....");
                        _this.parent().remove();
                      }, 1500);
                    if(res2.queryStatus === 1){                    
                    //Remove text
                    $("#assignee_Name").val("Select");
                    $("#Assignee_Task").val("");
                    $("#start_date").val("");
                    $("#pFeedBackDate").val("");

                    var new_proj_id = res2.new_id; 
                    
                      setTimeout(function(){  
                        $('#assSpinnerLabel').html("Task Assigned and mail sent!");
                        $('#spinnerAss').hide();
                        _this.parent().remove();
                      }, 2500);
                      setTimeout(function(){
                        $('.assignSpinner').hide();
                        $('#assSpinnerLabel').html("Assigning....");
                        $('#spinnerAss').show();
                      }, 7000);
                    //append text to UL
                    var assignee = "<li class='assign_li' name='"+new_proj_id+"'><a href='#' style='color: black;'>"+assigneeTask+"</a></li>";
                    $("#assigned-ul").prepend(assignee);
                    $("#no-task").html("");
                  }
                  else{
                      //do this
                      console.log(res2.queryMsg);
                  }               
                 }
        });
      }
          else{
            //DISPLAY ERROR MESSAGE
            $('.ass-errorMesss').css('display', 'block'); 
            $('.ass-errorMesss').html("<h5>Please fill the blanks</h5>");
          }
        
    });

    // //OPEN MODAL FOR INFORMATION ON ASSIGNED TASK
    $('#assigned-ul').on('click', '.assign_li', function(e){
      var modal = document.getElementById('asignTaskModal');
      var span = document.getElementsByClassName("ass-close");
      $('#asignTaskModal').fadeToggle("slow", function(){
        $('.ass-modal-content').slideDown(5000);
      });


      $(span).click(function(){
          modal.style.display = "none"; 
      });

      window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
      }
        //GET INFORMATION ON ASSIGNED TASK
        var assignLink = $(this).attr("name");
        $.ajax({
          type: "POST",
          url: "assets/ajax_get_member_task.php?update=<?=$project_id?>",
          data: {
                     'task_id': assignLink     
                },
          success: function(taskRes){                        
                    if (taskRes.status === 1) {
                      $("#assignee-name").html(taskRes.assigneeName);
                      $("#task-details").html(taskRes.Task);
                      $("#assigned-date").html(taskRes.task_assigned_date);
                      $("#start-date").html(taskRes.task_start_date);
                      $("#end-date").html(taskRes.task_completion_date);
                      $("#task-status").html(taskRes.task_status);

                      if (taskRes.task_status === "Completed") {
                        $("#finish-div").hide();
                        $("#task-status").html("Completed").css('color', 'green');
                      }
                      else if (taskRes.task_status === "Incomplete") {
                        $("#finish-div").show();
                        $("#task-status").html(taskRes.task_status).css('color', '#8B0000');
                      }
                    }
                    
                 }
        });
      

    });

//COMPLETE TASK BUTTON
$('#assigned-ul').on('click', '.assign_li', function(e){
    var nassignLink = $(this).attr("name");
    // console.log(nassignLink);
      $("#task_completed_btn").click(function(){
        
        var taskStatus = $("#task-status").html();
        console.log(taskStatus);

        if (taskStatus === "Incomplete") {
            $.ajax({
            type: "POST",
            url: "assets/ajax_complete_task.php?update=<?=$project_id?>",
            data: {
                       'task_id': nassignLink     
                  },
            success: function(completeRes){  
                      // console.log("Action Successful");
                      $("#task-status").html("Completed").css('color', 'green');
                      $("#finish-div").hide();
                    }
          });
        } else {
          alert("error");
        }
      });
});

    //ADD MEMBER TO PROJECT
     $("#add-member").click(function(e){
        
        var memberName = $('#member-name option:selected').text();
        var userId = $('#member-name').val();
        var memberRole = $('#member-role').val();
      e.preventDefault();
      if (memberName !== "") {
          $.ajax({
          type: "POST",
          url: "assets/ajax_add_member.php?update=<?=$project_id?>",
          data: {
                     'user_ID': userId,
                     'member_role': memberRole  
                },
          success: function(res2){  
                    if (res2.status === 1) {
                      
                      $('.mem-errorMesss').css('display', 'none');
                      //SPINNING BAR
                      $('.assignProgress').show();
                      setTimeout(function(){
                        $("#member-name").val("Select");
                        $("#member-role").val("Select");
                        $('#spinnerAddMemLabel').html("Member Added!");
                        $('#spinnerAddMem').hide();  
                        //APPEND TO MEMBERS LIST
                        memberRole = memberRole.toLowerCase();
                        if (memberRole == 'admin') {
                          memberRole = "Project Admin";
                        }else{
                          memberRole = " ";
                        }
                        memberId = res2.new_member; 
                        var addedMember = "<li class='member_li' id='tryLi'><div class='row'>"+memberName+"<button type='button' class='btn ml-auto rem_mem_btn' data-toggle='modal' data-target='#memberDeleteModal' name='"+memberId+"'><img src='img/icons8-delete-thick.svg' class='icon-remove-mem' id='remove-member'></button></div><div class ='row' id='adminSpan'>"+memberRole+"</div></li>";
                        $("#member-ul").prepend(addedMember);
                      }, 2000);
                      setTimeout(function(){
                        $('.assignProgress').hide();
                        $('#spinnerAddMemLabel').html("Adding...");
                        $('#spinnerAddMem').show();
                      }, 7000);
                      

                      //APPEND TO SELECT OPTION
                      var newMember = "<option value='"+userId+"'>"+memberName+"</option>";
                      $('#assignee_Name').append(newMember);
                      //REMOVE ERROR MESSAGE
                      var error = $('.ass-errorMesss');
                      if (error = true) {
                        $('.ass-errorMesss').css('display', 'none'); 
                        $('.ass-errorMesss').html("");  
                      }
                      //REMOVE THE NO MEMBER HEADLINE
                      var noMember = $("#no-member");
                      console.log($("#no-member"))
                      if ($("#no-member")) {
                         $("#no-member").empty();
                      }
                    } 

                   else if (res2.err_status === 1) {
                      $('.ass-errorMesss').css('display', 'block'); 
                      $('.ass-errorMesss').html(res2.err_msg);
                      $("#member-name").val("Select");
                    }                
                  }
        });
          
      }
      else {
            $('.mem-errorMesss').css('display', 'block'); 
            $('.mem-errorMesss').html("<h5>Please Input Member Name</h5>");
        }
    });


    //REMOVE MEMBER FROM PROJECT
    $('#member-ul').on('click', '.rem_mem_btn', function(e){
      var projectMemberId = $(this).attr("name");
      var _this = $(this);

      $("#confirmRemoveMember").click(function(e){
          $.ajax({
              type: "POST",
              url: "assets/ajax_remove_member.php?update=<?=$project_id?>",
              data: {
                       'member_id': projectMemberId    
                    },
              success: function(removeRes){
                        if (removeRes.status == 1) {
                          $('.removeSpinner').show();
                          setTimeout(function(){  
                            $('#spinnerLabel').html("Successfully Removed");
                            $('#spinnerRem').hide();
                            _this.parent().parent().remove();
                          }, 2000);
                        } 
                        else{
                          alert("error");
                        }
                      }
          });
      });
      $('.removeSpinner').hide();
      $('#spinnerRem').show();
    });

    //GET REMOVED MEMBER INFORMATION
    $('#member-ul').on('click', '.rem_mem_btn', function(e){
      var projectMemberId = $(this).attr("name");
      $.ajax({
              type: "POST",
              url: "assets/ajax_get_remove_member.php?update=<?=$project_id?>",
              data: {
                       'member_id': projectMemberId    
                    },
              success: function(removedRes){
                        if (removedRes.status == 1) {
                          var memberName = removedRes.memName;
                          var spinMessage = "Removing "+memberName;
                          $('#spinnerLabel').html(spinMessage);
                           $("#warnMessage").css('color','red');
                           var warningMessage = " "+memberName+" ";
                           $("#warnMessage").html(warningMessage);
                        }
                      }
          });
    });  
  });
</script>
</html>