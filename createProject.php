<!DOCTYPE html>
<html>
<head>
<?php include "includes/navBar.php"; ?>    
</head>
    <?php
    if (isset($_POST['saveProject'])) {

        if (empty($_POST['projectTitle']) && empty($_POST['projectOwner']) && empty($_POST['projectStakeholder']) && empty($_POST['pstart_date']) && empty($_POST['pdue_date'])) {
            echo "<div class='container errorMessage'><h3>Plese fill in blank spaces</h3></div>";
        } else{
                $aproject_title = $_POST['projectTitle'];
                $project_title = mysqli_real_escape_string($connection, $aproject_title);

                $aproject_owner = $_POST['projectOwner'];
                $project_owner = mysqli_real_escape_string($connection, $aproject_owner);

                $aproject_head = $_POST['projectHead'];
                $project_head = mysqli_real_escape_string($connection, $aproject_head);

                $aprojectStakeholder = $_POST['projectStakeholder'];
                $projectStakeholder = mysqli_real_escape_string($connection, $aprojectStakeholder);
                
                $pdescription = $_POST['pdescription'];
                $description = mysqli_real_escape_string($connection, $pdescription);
                //$date_created =  date('m-d-Y H:i:s'); 
                $pdate_created = (new DateTime())->format('Y-m-d H:i:s');

                $start_date = $_POST['pstart_date'];
                $pstart_date = date("Y-m-d",strtotime($start_date));

                $due_date = $_POST['pdue_date'];
                $pdue_date = date("Y-m-d", strtotime($due_date));



                $project_created_by = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
                $project_created_by_id = $_SESSION['user_id'];

                $query = "INSERT INTO projects (
                        project_title,
                        project_owner,
                        project_head,
                        start_date,
                        due_date,
                        stakeholders,
                        description,
                        date_created,
                        created_by
                        ) 
                        VALUES (
                         '$project_title',
                         '$project_owner',
                         '$project_head',
                         '$pstart_date',
                         '$pdue_date',
                         '$projectStakeholder',
                         '$description',
                         '$pdate_created',
                         '$project_created_by'
                     )";

                $result = mysqli_query($connection, $query);
                if ($result) {
                    $last_proj_id = mysqli_insert_id($connection);

                    $add_member_query = "INSERT INTO project_members (
                                        project_id, user_id, member_role) 
                                        VALUES (
                                        '$last_proj_id',
                                        '$project_created_by_id',
                                        'admin'
                                        )";
                    $add_member_result = mysqli_query($connection, $add_member_query);
                    if (!$add_member_query) {
                        die("Add Member query failed" . mysqli_error($connection));
                    }

                } else {
                    die("Database query failed" . mysqli_error($connection));
                }
            }

    }
?>
<style type="text/css">
    .errorMessage{
        color: red;
        padding-top: 10px;
        text-align: center;
        font-weight: 300;
    }
    .mem-errorMesss{
        color: red;
        padding-top: 10px;
        font-weight: 20;
        text-transform: uppercase;
    }
    #proj-mem-hd{
        font-size: 32.5px;
        font-weight: 350;
        font-style: normal;
    }
    .label-sty{
        font-weight: 450;
    }
    .input-sty{
        border-radius: 15px;
    }
    .form-control:focus{
    border-color: #cccccc;
    box-shadow: none;
}
</style>
<body style="background: #DCDCDC;">
        <div class="container" style="margin-top: 30px; margin-bottom: 30px; background-color: #fff; padding-top:30px; padding-bottom: 20px; border-radius: 25px;">
        <div class="errorMessage" style="display: none;"></div>
            <div class="offset-md-1">
                <h3 class="display-4 container" style="font-size: 30px;">Create a new Project</h3>
            </div>
                            
            <div style="margin-top: 20px;">
                <form action="createProject.php" method="post">
                    <div class="col col-sm-10 offset-md-1">
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Project Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sty" name="projectTitle" id="projectTitle">
                             </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Project Owner</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sty" name="projectOwner" id="projectOwner">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Project Head</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sty" name="projectHead" id="projectHead">
                            </div>
                        </div>             
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Start Date</label>
                            <input type="date" style="width: 250px; margin-left:15px;" class="form-control input-sty" name="pstart_date" id="pStartDate">
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Due Date</label>
                                <input type="date" style="width: 250px; margin-left:15px;" class="form-control input-sty" name="pdue_date" id="pDueDate">
                        </div>
                        <!---Project Stakeholders-->
                        <div class="form-group row">
                            <label class="col-3 col-form-label label-sty">Project Stakeholders</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sty" name="projectStakeholder" id="projectStakeholder">
                            </div>
                        </div> 
                        <!---Project Stakeholders-->

                        <!---Description-->
                        <div class="form-group row mb-4">
                            <label class="col-sm-3 col-form-label label-sty">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control input-sty" name="pdescription" id="projectDescription"></textarea>
                            </div>
                        </div>
                        <!-- <div id="ret_data"></div> -->
                        <div class="row mt-4 container">
                            <button class="btn btn-md btn-primary mr-4" name="saveProject" id="createProject">Save</button>
                            <button class="btn btn-md btn-primary" id="clear-btn">Clear</button>
                        </div>
                    </div> 
                </form>
            </div>
        </div>

<?php include("includes/footerLinks.php")?>
</body>
<script type="text/javascript">
$(document).ready(function(){
    
$("#createProject").click(function(e){
        var projectTitle = $("#projectTitle").val();
        var projectOwner = $("#projectOwner").val();
        var projectHead = $("#projectHead").val();

        var projectStartDate = $("#pStartDate").val();
        var projectDueDate = $("#pDueDate").val();

        var projectStakeholder = $("#projectStakeholder").val();
        var projectDescription = $("#projectDescription").val();

      e.preventDefault();
      if (projectTitle !== "" && projectOwner !== "" && projectStartDate !== "" && projectDueDate !== "" && projectStakeholder !== "" && projectDescription !== "") {
          $.ajax({
          type: "POST",
          url: "assets/ajax_create_project.php",
          data: {
                    'project_title': projectTitle,
                    'project_owner': projectOwner,
                    'projectHead':projectHead,
                    'project_start_date': projectStartDate,
                    'project_due_date': projectDueDate,
                    'project_stakeholder': projectStakeholder,
                    'project_description': projectDescription
                },
          success: function(res2){                   
                    $("#projectTitle").val("");
                    $("#projectOwner").val("");
                    $("#projectHead").val("");
                    $("#pStartDate").val("");
                    $("#pDueDate").val(""); 
                    $("#projectStakeholder").val("");
                    $("#projectDescription").val("");
                    location.replace("ongoing_projects.php");
                    }
        });
      }
      else {
            var projectTitle = $("#projectTitle").val();
            var projectOwner = $("#projectOwner").val();
            var projectHead = $("#projectHead").val();

            var projectStartDate = $("#pStartDate").val();
            var projectDueDate = $("#pDueDate").val();

            var projectStakeholder = $("#projectStakeholder").val();
            var projectDescription = $("#projectDescription").val();

            $('.errorMessage').html("<h5>Please Fill  Blank Spaces</h5>");
            $('.errorMessage').css('display', 'block');
        }
        
    });
    
    
    $('#clear-btn').click(function(e){
        var projectTitle = $("#projectTitle").val();
        var projectOwner = $("#projectOwner").val();
        var projectHead = $("#projectHead").val();

        var projectStartDate = $("#pStartDate").val();
        var projectDueDate = $("#pDueDate").val();

        var projectStakeholder = $("#projectStakeholder").val();
        var projectDescription = $("#projectDescription").val();

        projectTitle = "";
        projectStartDate = "";
        projectDueDate = "";
        projectStakeholder = "";
        projectDescription = "";
        projectOwner = "";


    });


   



});

</script>
</html>