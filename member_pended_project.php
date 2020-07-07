<!DOCTYPE html>
<html>
<head>
    <title>Pending Projects</title>
    <?php include "includes/navBar.php"; ?>
</head>
<body style="background:#F5F5F5;">
    <div>
        <?php
            $sess_user_id = $_SESSION['user_id'];
$query = "SELECT 
        project_members.member_id,
        project_members.project_id,
        project_members.member_role,
        projects.project_title,
        projects.project_owner,
        projects.start_date,
        projects.due_date,
        projects.date_created,
        projects.created_by,
        users.firstName,
        users.lastName,
        users.email,
        users.user_role
        FROM projects
        LEFT JOIN project_members ON projects.project_id = project_members.project_id
        LEFT JOIN users ON project_members.user_id = users.user_id
        LEFT JOIN projects_update ON projects_update.project_id = projects.project_id
        WHERE project_members.user_id = '{$sess_user_id}'
        AND projects.status = 'Pending'";

$result = mysqli_query($connection, $query);

if(!$result){
    die("Database conneciton failed: " . mysqli_error($connection));
}
             

?>
    </div>
    <div class="container">
        <div>
            <div id="adminHeadWord">
                <h6 id="completedLabel">Pended Projects</h6>
            </div>
                <table id="all-projects-table" class="table table-bordered table-hover">
                    <tr>
                        <th>Project Title</th>
                        <th>Project Created By</th>
                        <th>Project Owner</th>
                        <th>Due Date</th>
                        <th>Action</th>
                        
                    </tr>
                     <?php
                     if (mysqli_num_rows($result) > 0 ) {
                        while($row = mysqli_fetch_assoc($result)){
                            $project_id = $row['project_id'];
                            $p_title = $row['project_title'];
                            $p_creator = $row['created_by'];
                            $p_owner = $row['project_owner'];
                            $p_due_date = $row['due_date'];
                    ?>
                    <div id="proj_val_div" style="visibility: hidden; display: inline;"><?php echo $project_id; ?></div>
                    <tr class="mr-2">
                        <td> <?php echo $p_title;?> </td>
                        <td> <?php echo $p_creator;?> </td>
                        <td> <?php echo $p_owner;?> </td>
                        <td><?php echo date("jS F Y",strtotime($p_due_date));?></td>
                        <td>
                            <div class="">
                                <div class="update_lnk m-auto" id="update_lnk_upd">
                                    <a id="update_link" href="" name="<?php echo $project_id; ?>">Open</a>
                                </div>
                            </div> 
                        </td>
                        <?php
                        }      
                        } else {
                            echo "<tr class='mr-2'>
                            <td> No Project Pended</td><td></td><td></td><td></td><td> </td> </tr>";
                        }
                        ?>
                    </tr>
                   
                </table>
        </div>    
    </div>
</body>
<?php include "includes/footerLinks.php";?>
<script type="text/javascript">
    $("#update_link").click(function() {
        var projectID = $("#update_link").attr("name");
        $.ajax({
              type: "POST",
              url: "assets/ajax_unpend_project.php",
              data: {
                      'proj_id': projectID
                    },
              success: function(res){
                if (res.status == 1) {
                    location = "ongoing_projects_rebrand.php?update="+projectID;
                }
              }
        });
    });
</script>
</html>