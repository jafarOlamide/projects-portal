
<!DOCTYPE html>
<html>
<head>
    <title>Completed Projects</title>
    <?php 
        include "includes/navBar.php"; 
        $sess_user_id = $_SESSION['user_id'];
    ?>
</head>
<body>
    <div class="container">
        <div>
            <div class="mt-4">
            <div id="adminHeadWord">
				<h6 id="completedLabel">Closed Projects</h6>
			</div>
                <table id="completed-table" class="table table-bordered table-hover">
                    <tr class="mr-2">
                        <th>Project Title</th>
                        <th>Project Created By</th>
                        <th>Project Owner</th>
                        <th>Project Head</th>
                        <th>Date Closed</th>
                    </tr>
                <?php
                    $query = "SELECT 
                                project_members.member_id,
                                project_members.project_id,
                                projects.project_title,
                                projects.project_owner,
                                projects.project_head,
                                projects.created_by,
                                projects.due_date,
                                users.firstName,
                                users.lastName
                                FROM projects
                                LEFT JOIN project_members ON projects.project_id = project_members.project_id
                                LEFT JOIN users ON project_members.user_id = users.user_id
                                WHERE project_members.user_id = '{$sess_user_id}'
                                AND projects.status ='Completed'";

                    $result = mysqli_query($connection, $query);
                    if(!$result){
                      die("Database connection failed: " . mysqli_error($connection));
                    }
                    else {
                        if (mysqli_num_rows($result) > 0 ) {

                            while($row = mysqli_fetch_assoc($result)){
                                $p_title = $row['project_title'];
                                $p_creator = $row['created_by'];
                                $p_owner = $row['project_owner'];
                                $p_date_completed = $row['due_date'];
                                $p_head = $row['project_head'];
                    ?>
                            <tr class="mr-2">
                                <td> <?php echo $p_title;?> </td>
                                <td> <?php echo $p_creator;?> </td>
                                <td> <?php echo $p_owner;?> </td>
                                <td> <?php echo $p_head;?> </td>
                                <td> <?php echo  date("jS F Y",strtotime($p_date_completed)); ?></td>
                        <?php 
                            }
                        } else {
                            echo "<tr class='mr-2'>
                            <td> No Project Completed yet </td><td></td><td></td><td></td><td> </td> </tr>";
                        }
                        ?>
                    </tr>
                    <?php                         
                    }
                    ?>
                    
                   
                </table>
            </div>
        </div>    
    </div>
</body>
<?php include "includes/footerLinks.php"?>
</html>