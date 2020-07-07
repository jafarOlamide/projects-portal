<?php
include_once "../admin/config/server.php";    $aproject_title = $_POST['project_title'];
    $project_title = mysqli_real_escape_string($connection, $aproject_title);

    $aproject_owner = $_POST['project_owner'];
    $project_owner = mysqli_real_escape_string($connection, $aproject_owner);

    $aproject_head = $_POST['projectHead'];
    $project_head = mysqli_real_escape_string($connection, $aproject_head);

    $aprojectStakeholder = $_POST['project_stakeholder'];
    $projectStakeholder = mysqli_real_escape_string($connection, $aprojectStakeholder);

    $pdescription = $_POST['project_description'];
    $description = mysqli_real_escape_string($connection, $pdescription);

    $start_date = $_POST['project_start_date'];
    $pstart_date = date("Y-m-d",strtotime($start_date));

    $due_date = $_POST['project_due_date'];
    $pdue_date = date("Y-m-d", strtotime($due_date));


    $pdate_created = (new DateTime())->format('Y-m-d H:i:s');
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
                                        project_id, 
                                        user_id 
                                        ) VALUES (
                                        '$last_proj_id',
                                        '$project_created_by_id'
                                        )";
                    $add_member_result = mysqli_query($connection, $add_member_query);
                    if (!$add_member_query) {
                        die("Add Member query failed" . mysqli_error($connection));
                    }
                } else {
                    die("Database query failed" . mysqli_error($connection));
                }
?>
