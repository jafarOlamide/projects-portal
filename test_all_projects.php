<!DOCTYPE html>
<html>
<head>
    <?php include "includes/navBar.php"; ?>
</head>
<body style="background:#F5F5F5;">
    <div>
        
        <?php
$query = "SELECT 
            project_id,
            project_title,
            project_owner,
            created_by,
            due_date
            FROM projects";

$result = mysqli_query($connection, $query);

if(!$result){
    die("Database conneciton failed: " . mysqli_error($connection));
}
             

?>
    </div>
    <div class="container" id="major-container">
        <div>
            <div id="userHeadWord">
                <h6 id="headLabel">All Projects</h6>
            </div>
            <!-- <h2 id="head-word">All Projects</h2> -->
            <div>
                <table id="all-projects-table" class="table table-bordered table-hover">
                    <tr>
                        <th>Project Title</th>
                        <th>Project Created By</th>
                        <th>Project Owner</th>
                        <!-- <th style="width: 200px; text-align: center;">Action</th> -->
                        
                    </tr>
                     <?php
                    while($row = mysqli_fetch_assoc($result)){
                        $project_id = $row['project_id'];
                        $p_title = $row['project_title'];
                        $p_creator = $row['created_by'];
                        $p_owner = $row['project_owner'];
                        $p_date_completed = $row['due_date'];
                    ?>
                    <div id="proj_val_div" style="visibility: hidden; display: inline;"><?php echo $project_id; ?></div>
                    <tr class="mr-2">
                        <td> <?php echo $p_title;?> </td>
                        <td> <?php echo $p_creator;?> </td>
                        <td> <?php echo $p_owner;?> </td>
                        <!-- <td>
                            <div class="row">
                                <div class="update_lnk m-auto" id="update_lnk_upd">
                                    <a id="update_link" href="ongoing_projects_rebrand.php?update=<?php //echo $project_id?>">Update</a>
                                </div>
                                <div class="update_lnk m-auto" id="update_lnk_edit">
                                    <a id="edit_link" href="edit_project.php?edit=<?php echo $project_id?>">Edit</a>
                                </div>
                            </div> 
                        </td> -->
                        <?php
                            
                        }
                        ?>
                    </tr>
                   
                </table>
            </div>
        </div>    
    </div>
</body>
<?php include "includes/footerLinks.php";?>
<script type="text/javascript">
    //$('#proj_div').hide();
    var server_url = document.getElementById("update_link").getAttribute('href');
    //console.log(server_url);
    // var proj_id_val = document.getElementById("proj_val_div").innerHTML;
    // console.log(proj_id_val);
    $("#update_link").click(function(){
        $.ajax({
            type: "GET",
            url:  server_url,
            success: function(event){
                console.log(event);
            }
        })
    });
</script>
</html>