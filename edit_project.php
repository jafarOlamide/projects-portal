<!DOCTYPE html>
<html>
<head>
    <title>Edit Project</title>
    <?php include "includes/navBar.php"; ?>

</head>
    <?php //include "includes/headLinks.php"; ?>
    <body style="background: #DCDCDC;">
        <div>
            <?php 
                if (!isset($_SESSION['user_id'])) {
                  header("Location: index.php"); 
                  }
                  $sess_user_id = $_SESSION['user_id'];
            ?>
            <?php      
                //include 'server.php';
                if (isset($_POST['saveProject'])) {
                    $result = mysqli_query($connection, $query);
                    if (!$result) {
                        die("Database query failed" . mysqli_error());
                    }
                }
            ?>

    </div>
        <div class="container" style="margin-top: 30px; margin-bottom: 30px; background-color: #fff; padding-top:30px; padding-bottom: 20px; border-radius: 25px;">
            <div class="offset-md-1">
                <h3 class="mb-4 display-4" style="font-size: 40px;">Edit Project Details</h3>
            </div>
            
        <div style="margin-top: 60px;">
            <?php 
                    if (isset($_GET['edit'])) {

                        $proj_id = $_GET['edit'];

                        $query = "SELECT * FROM projects WHERE project_id = $proj_id";
                        $select_query = mysqli_query($connection, $query);

                        while ($select_row = mysqli_fetch_assoc($select_query)) {
                            $the_project_id = $select_row['project_id'];
                            $project_title = $select_row['project_title'];
                            $project_owner = $select_row['project_owner'];
                            $project_head = $select_row['project_head'];
                            $project_stakeholder = $select_row['stakeholders'];

                            $date_created = $select_row['date_created'];
                            //$date_created = date("d/m/y H:i:s");

                            $start_date = $select_row['start_date'];
                            $pstart_date = date("Y-m-d",strtotime($start_date));
                            //$pstart_date = date_format($ppstart_date, 'Y-m-d H:i:s');

                            $due_date = $select_row['due_date'];
                            $pdue_date = date("Y-m-d",strtotime($due_date));

                            $created_by = $select_row['created_by'];
                            $status = $select_row['status'];
                            $project_description = $select_row['description'];  
                          
                ?>
            <form action="" method="post">
                
            <div class="col col-sm-10 offset-md-1">
                <div class="form-group row mb-4">
                    <label class="col-sm-3 col-form-label">Project Title</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="projectTitle" value="<?php if(isset($project_title)){ echo $project_title;} ?>">
                     </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-3 col-form-label">Project Owner</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="projectOwner" value="<?php if(isset($project_owner)) {echo $project_owner;} ?>">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-3 col-form-label">Project Head</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="projectHead" value="<?php if(isset($project_head)) {echo $project_head;} ?>">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-sm-3 col-form-label">Project Created By</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="project_created_by" readonly value="<?php if(isset($created_by)) {echo $created_by;} ?>">
                    </div>
                </div>
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Date Created</label>
                        <div class="col-sm-6 row">
                            <input style="width: 250px; margin-left:15px;" class="form-control" name="pdate_created" value="<?php if(isset($date_created)) {echo $date_created;} ?>"readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                        <input type="date" style="width: 250px; margin-left:15px;" class="form-control" name="pstart_date" value="<?php if(isset($pstart_date)) {echo $pstart_date; }?>">
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Due Date</label>
                        <div class="col-sm-6 row">
                            <input type="date" style="width: 250px; margin-left:15px;" class="form-control" name="pdue_date" value="<?php if(isset($pdue_date)) {echo $pdue_date; }?>">
                        </div>
                    </div>
                    <!---Project Stakeholders-->
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Project Stakeholders</label>
                        <div class="col-6">
                            <input type="text" class="form-control" name="projectStakeholder" value="<?php if(isset($project_stakeholder)) {echo $project_stakeholder; }?>">
                        </div>
                    </div> 
                    <!---Project Stakeholders-->

                    <!---Description-->
                    <div class="form-group row mb-4">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-6">
                            <textarea class="form-control"8 name="pdescription"><?php if(isset($project_description)) {echo $project_description;} ?></textarea>
                        </div>
                    </div>            

<?php 
   }
}         
?>
            
        <!----Assign Task---->
        <?php 
                     if (isset($_POST['editProject'])) {
                            $edit_proj_title = $_POST['projectTitle'];
                            $edit_project_owner = $_POST['projectOwner'];
                            $edit_project_head = $_POST['projectHead'];
                            
                            $pedit_start_date = $_POST['pstart_date'];  
                            $edit_start_date = date("Y-m-d H:i:s",strtotime($pedit_start_date));

                            $pedit_due_date = $_POST['pdue_date'];
                            $edit_due_date = date("Y-m-d H:i:s",strtotime($pedit_due_date));

                            $edit_description = $_POST['pdescription'];
                            $edit_stakeholder = $_POST['projectStakeholder'];
                            
                            $update = "UPDATE projects SET 
                                        project_title = '{$edit_proj_title}',
                                        project_owner = '{$edit_project_owner}',
                                        project_head = '{$edit_project_head}',
                                        start_date = '{$edit_start_date}',
                                        due_date = '{$edit_due_date}',
                                        stakeholders= '{$edit_stakeholder}',
                                        description = '{$edit_description}' WHERE project_id = '{$the_project_id}'";
                            $update_query = mysqli_query($connection, $update);

                            if (!$update_query) {
                                die("update Query Failed: " . mysqli_error($connection));
                            }
                            header("Location: ongoing_projects_rebrand.php?update=$the_project_id");
                        }
                ?>
                <div id="ret_data"></div>
                <div class="row mt-4">
                    <button class="btn btn-md btn-primary mr-4" name="editProject" type="submit">Save Edit</button>
                    <button class="btn btn-md btn-primary mr-4">Clear</button>
                </div> 
                </div>
                
                </form>
                
            </div>
        </div>
    </body>
   <?php include("includes/footerLinks.php")?>
</html>