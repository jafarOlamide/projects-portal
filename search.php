<body>
    <div>
        <?php include "includes/navBar.php"; 
            if (!isset($_SESSION['user_id'])) {
                  header("Location: index.php"); 
      }
      $sess_user_id = $_SESSION['user_id'];
        ?>
    </div>
<div class="container">

<?php include "server.php"; ?>
 <?php
if (isset($_POST['search_button'])) {
  # code...
  $tsearch_input = $_POST['search_input'];
  $search_input = mysqli_escape_string($connection, $tsearch_input);
  if ($search_input == "") {
    // echo "<h3 style='padding-top:20px;'>Please Insert Input";
    header("Location: dashboard.php");
  }
  if ($search_input !== "") {
      $query = "SELECT  
                projects.project_id ,
                projects.due_date ,
                projects.project_owner,
                projects.created_by,
                projects.project_title  
                FROM projects
                INNER JOIN project_members ON projects.project_id = project_members.project_id
                WHERE projects.project_title LIKE '%$search_input%' AND project_members.user_id = '{$sess_user_id}'";

  $search_query = mysqli_query($connection, $query);

  if (!$search_query) {
    die("SEARCH QUERY FAILED: " . mysqli_error($connection));
  }

  $count = mysqli_num_rows($search_query);
    if ($count == 0) {
        echo "<h3 class='mt-4'>No Results Found</h3>";
    } else{ 
    ?> 
        <div>
            <div class="mt-4">
                <h2>Projects</h2>
                <table style="width: 100%;" class="table">
                    <tr class="mr-2">
                        <th>Project Title</th>
                        <th>Project Created By</th>
                        <th>Project Owner</th>
                        <th>Date Completed</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                     <?php
                    while($row = mysqli_fetch_assoc($search_query)){
                        $project_id = $row['project_id'];
                        $p_title = $row['project_title'];
                        $p_creator = $row['created_by'];
                        $p_owner = $row['project_owner'];
                        $p_date_completed = $row['due_date'];
                    ?>
                    <tr class="mr-2">
                        <td> <?php echo $p_title;?> </td>
                        <td> <?php echo $p_creator;?> </td>
                        <td> <?php echo $p_owner;?> </td>
                        <td> <?php echo $p_date_completed; ?></td>
                        <td>
                            <div class="row" style="margin-left: 15px; margin-left: 15px;">
                                <div class="update_lnk m-auto" id="update_lnk_upd">
                                    <a id="update_link" href="ongoing_projects_rebrand.php?update=<?php echo $project_id?>">Update</a>
                                </div>
                                <div class="update_lnk m-auto" id="update_lnk_edit">
                                    <a id="edit_link" href="edit_project.php?edit=<?php echo $project_id?>">Edit</a>
                                </div>
                            </div> 
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
                   
                </table>
            </div>
        </div>    
    </div>
</body>
  <?php }
}
  }

?>
<?php include "includes/footerLinks.php";?>
