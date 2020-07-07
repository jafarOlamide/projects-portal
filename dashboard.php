<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="height: 100%;">
    <?php include "includes/navBar.php"; 
        $sess_user_email = $_SESSION['user_id'];
        $query_user_session = mysqli_query($connection, "SELECT user_id FROM users WHERE user_id = '{$sess_user_email}'");
        if (!$query_user_session) {
            die("Query Failed:" . mysqli_error($connection));
        }
        while ($row = mysqli_fetch_assoc($query_user_session)) {
            $sess_user_id = $row['user_id'];
        }
    ?>
<div style="background: #F5F5F5; padding-top: 1px; padding-bottom: 0px;">
  <!-- Summary -->
    <div class="container" id="dashboard_cont">
<br>
    <!--Summary-->      
      <div class="col summary_div">
        <div>
            <!-- <div class="panel flat-border"> -->
                <div class="panel-body">
                        <div class="col-12">
                            <h4>Portal Summary</h4>
                            <hr>
                        </div>

                    <div class="row text-center">
                        <div class="col-sm-6 col-md-3 margin-bottom-10">
                            <b>All Projects</b>
                            <h2><?php 
                                $query = "SELECT projects.project_id,
                                count(projects.project_id) as 'total_projects' 
                                FROM projects
                                LEFT JOIN project_members ON project_members.project_id = projects.project_id
                                WHERE project_members.user_id = '{$sess_user_id}'";
                                $project_display_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($project_display_query);
                                echo $row['total_projects'];
                                ?>
                            </h2>
                            <a href='member_all_projects.php'>
                                <button class="btn mainone-bg btn-sm view_btn">View All</button>
                            </a>
                        </div>

                        <div class="col-sm-6 text-sm-center col-md-3 border-left-right margin-bottom-10">
                            <b>Ongoing Projects</b>
                            <h2 id="openedTickets"><?php 
                                $query = "SELECT count(IF(projects.status='Ongoing',1, NULL)) as 'ongoing_projects' FROM projects 
                                LEFT JOIN project_members ON project_members.project_id = projects.project_id
                                WHERE project_members.user_id = '{$sess_user_id}'";
                                $project_display_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($project_display_query);
                                echo $row['ongoing_projects'];
                                ?>
                            </h2>
                            <a href='ongoing_projects_rebrand.php'>
                                <button class="btn mainone-bg btn-sm view_btn">View All</button>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-3 border-left-right margin-bottom-10 text-sm-center">
                            <b>Pended Projects</b>
                            <h2><?php 
                                $query = "SELECT count(IF(projects.status='Pending',1, NULL)) as 'pending_projects' FROM projects
                                LEFT JOIN project_members ON project_members.project_id = projects.project_id
                                WHERE project_members.user_id = '{$sess_user_id}'";
                                $project_display_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($project_display_query);
                                echo $row['pending_projects'];
                             ?></h2>
                            <a href='member_pended_project.php'>
                                <button class="btn mainone-bg btn-sm view_btn">View All</button>
                            </a>
                        </div>

                        <div class="col-sm-6 col-md-3 margin-bottom-10 text-sm-center">
                            <b>Closed Projects</b>
                            <h2><?php 
                                $query = "SELECT count(IF(projects.status='Completed',1, NULL)) as 'closed_projects' FROM projects
                                LEFT JOIN project_members ON project_members.project_id = projects.project_id
                                WHERE project_members.user_id = '{$sess_user_id}'";
                                $project_display_query = mysqli_query($connection, $query);

                                $row = mysqli_fetch_assoc($project_display_query);
                                echo $row['closed_projects'];
                             ?></h2>
                            <a href='member_completed_projects.php'>
                                <button class="btn mainone-bg btn-sm view_btn">View All</button>
                            </a>
                        </div>
                    </div>

                <!-- </div> -->
            </div>
        </div>

    </div>
    <!--Summary--> 

    <div id="recent_updates_div">
        <?php
                    //SELECT PROJECT DETAILS
                  $query =  "SELECT 
                                project_members.member_id,
                                project_members.project_id,
                                projects.project_title,
                                projects.project_owner,
                                projects.project_head,
                                users.firstName,
                                users.lastName,
                                projects_update.date_added
                                FROM projects
                                LEFT JOIN project_members ON projects.project_id = project_members.project_id
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
                   ?>
        <div style="margin-bottom: 30px;">
            <h5>Recently Updated Projects</h5>
            <hr>
        </div>
        <!-- Recently Updated Project -->
        <div id="recent-projects-table-div">
            <table class="table table-bordered table-hover" id="recents-table">
                <tr>
                   <th>Project Title</th>
                   <th>Project Owner</th>
                   <th>Project Head</th>
                   <th>Last Updated</th>
                </tr>
                <tr>
                <?php
                    while ( $row = mysqli_fetch_assoc($project_details_query)) {
                        $proj_title = $row['project_title'];
                        $proj_owner = $row['project_owner'];
                        $proj_head = $row['project_head'];
                        $proj_last_updated = $row['date_added'];
                     
                 ?>
                    <td><?php echo $proj_title; ?></td>
                    <td><?php echo $proj_owner; ?></td>
                    <td><?php echo $proj_head; ?></td>
                    <td><?php echo date("g:ia, jS F Y", strtotime($proj_last_updated)); ?></td> 
                </tr>
                <?php 
                  } 
                ?>
            </table>
        </div>
    </div>  

        <div id="recent_edit_div">
            <?php 
               $tasks = "SELECT
                        projects.project_id,
                        projects.project_title,
                        COUNT(assign_task.id) AS 'total_tasks',
                        count(IF(assign_task.status='Incomplete',1, NULL)) as 'unfinished_tasks',
                        COUNT(IF(assign_task.status='Completed', 1, NULL)) as 'completed_tasks'
                        FROM projects 
                        INNER JOIN assign_task ON assign_task.project_id = projects.project_id
                        LEFT JOIN project_members ON project_members.project_id = projects.project_id
                        WHERE project_members.user_id = '{$sess_user_id}'
                        AND projects.status = 'Ongoing'
                        GROUP BY projects.project_id";
                $tasks_query = mysqli_query($connection, $tasks);
                if (!$tasks_query) {
                    die(mysqli_error($connection));
                }
            ?>
            <div style="margin-bottom: 30px;">
                <h5>Projects Tasks</h5>
                <hr>
            </div>
            <!-- Recently Updated Project -->
            <div id="tasks-table-div">
                <table class="table table-bordered table-hover" id="tasks-table">
                   <tr>
                       <th>Project Title</th>
                       <th>Total Tasks</th>
                       <th>Completed Tasks</th>
                       <th>Unfinished Tasks</th>
                   </tr>
                   <?php 
                   if (mysqli_num_rows($tasks_query) > 0 ) {
                   while ($tasks_row = mysqli_fetch_assoc($tasks_query)) {
                        $proj_title = $tasks_row['project_title'];
                        $total_tasks = $tasks_row['total_tasks'];
                        $completed_tasks = $tasks_row['completed_tasks'];
                        $unfinished_tasks = $tasks_row['unfinished_tasks'];

                        if ( $total_tasks > 1 || $completed_tasks > 1 || $unfinished_tasks > 1) {
                            
                            $total_tasks =  $total_tasks . " tasks";
                            $completed_tasks = $completed_tasks . " tasks"; 
                            $unfinished_tasks = $unfinished_tasks . " tasks";    
                        }
                        elseif ( $total_tasks = 1 || $completed_tasks = 1 || $unfinished_tasks = 1) {
                            
                            $total_tasks =  $total_tasks . " task";
                            $completed_tasks = $completed_tasks . " task"; 
                            $unfinished_tasks = $unfinished_tasks . " task"; 
                        }
                        elseif ($total_tasks < 1 || $completed_tasks < 1 || $unfinished_tasks < 1) {
                            
                            $total_tasks =  $total_tasks . " task";
                            $completed_tasks = $completed_tasks . " task"; 
                            $unfinished_tasks = $unfinished_tasks . " task"; 
                        }
                    ?>
                   <tr>
                    
                        <td><?php echo $proj_title; ?></td>
                        <td><?php echo $total_tasks; ?></td>
                        <td><?php echo $completed_tasks; ?></td>
                        <td><?php echo $unfinished_tasks; ?></td>
                    </tr>
                    <?php 
                        }
                    } else{
                        echo "<tr class='mr-2'>
                                <td> No Task Assigned Yet</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td> </td> 
                            </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>  
    </div>

</div>
    <?php include'includes/footerLinks.php'; ?>