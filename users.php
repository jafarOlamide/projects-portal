<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<?php require_once "includes/navBar.php"; ?>
</head>
<body style="background:#F5F5F5;">
<?php 
	$user_query = mysqli_query($connection, "SELECT user_id, firstName, lastName, email FROM users ORDER BY firstName ASC");
	if(!$user_query){
    	die("Database connection failed: " . mysqli_error($connection));
	}
	?>

	<div class="container ">
		<div class="mt-4" style="margin-top: 100px;">
			<div class="row">
				<div class="col-md-4 my-2">
					<div class="delUser-errorMesss"></div>
					<button class="btn btn-inline btn-primary" id="addUserButton" data-toggle="modal" data-target="#addUserModal">Add User</button>
					<button class="btn btn-secondary" id="deleteUserButton"><span><img src="img/recycling-bin.svg" style="height: 30px; width: 30px;"></span></button>
					<!--Add User Modal -->
					<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div class="addUser-errorMesss" style="display: none;"></div>
                            <div class="addUserProgress">
                            	<i class="fa fa-spinner fa-spin" id="addUserSpinner"></i>
                                <label id="addUserSpinnerLabel">Adding User....</label>
                            </div>
					        <form>
					          <div class="row">
					          	<div class="form-group col">
						            <label for="recipient-name" class="col-form-label">First Name</label>
						            <input type="text" class="form-control" id="userFirstName">
					          	</div>
					          	<div class="form-group col">
						            <label for="recipient-name" class="col-form-label">Last Name</label>
						            <input type="text" class="form-control" id="userLastName">
					          	</div>
					          </div>
					          <div class="form-group">
					            <label for="message-text" class="col-form-label">Email</label>
					            <input type="text" class="form-control" id="userEmail">
					          </div>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-sm btn-primary" id="btnAddUser">Add User</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!--Add User Modal -->
				</div>
				<div class="col-md-5 ml-auto my-2">
					<div class="form-group">
						<input type="text" name="" class="form-control" style="height: 45px;" placeholder="Search Users" id="search_users">
						<!-- <button class="btn btn-primary form-inline" style="height: 45px;">Search</button> -->
					</div>
				</div>
			</div>
		</div>
		<div id="users_table_div">
			<div id="userHeadWord">
				<h6 id="headLabel">Users</h6>
			</div>
            <table id="users-table" class="table table-bordered table-hover">
                <thead>
                	<tr>
	                	<th id="user_sel"></th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Edit</th>
	                    <!-- <th>Status</th> -->
                	</tr>
                </thead>
                <tbody id="tUserBody">
	                <?php 
						while ($user_row = mysqli_fetch_assoc($user_query)) {
							$user_id = $user_row['user_id'];
							$full_name = $user_row['firstName'] ." " .$user_row['lastName'];
							$user_email = $user_row['email'];
						?>
	                <tr id="tr_<?= $user_id ?>">
	                	<td><input type="checkbox" name="<?php echo $user_id; ?>"></td>
	                    <td> <?php echo $full_name;?> </td>
	                    <td> <?php echo $user_email;?> </td>
	                    <td class="editTd"><button class="btn editBtn" name="<?php echo $user_id; ?>" data-toggle="modal" data-target="#editUserModal"><img src="img/edit.svg" class="editImg"></button></td>
	                    <!-- <td></td> -->
	                    <?php                            
	                    }
	                    ?>
	                </tr>
                </tbody>       
            </table>
            <!--Edit Member Details Modal -->
			<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Update User Info</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
				      	<div class="addUser-errorMesss" style="display: none;"></div>
                        <div class="addUserProgress">
                        	<i class="fa fa-spinner fa-spin" id="addUserSpinner"></i>
                            <label id="addUserSpinnerLabel">Updating....</label>
                        </div>
				        <form>
				        	<input type="text" id="getUserId" style="display: none;">
				          <div class="row">
				          	<div class="form-group col">
					            <label for="recipient-name" class="col-form-label">First Name</label>
					            <input type="text" class="form-control" id="editFirstName">
				          	</div>
				          	<div class="form-group col">
					            <label for="recipient-name" class="col-form-label">Last Name</label>
					            <input type="text" class="form-control" id="editLastName">
				          	</div>
				          </div>
				          <div class="form-group">
				            <label for="message-text" class="col-form-label">Email</label>
				            <input type="text" class="form-control" id="editEmail">
				          </div>
				        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-sm btn-primary" id="updateBtn">Update</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!--Edit Member Details Modal -->
		</div>			
	</div>
</body>
</html>