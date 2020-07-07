<!DOCTYPE html>
<html>
<head>
	<title>Administrators</title>
	<?php require_once "includes/navBar.php"; ?>
</head>
<body style="background:#F5F5F5;">
<?php 
	$admin_query = mysqli_query($connection, "SELECT user_id, firstName, lastName, email FROM users WHERE user_role = 'admin'");
	if(!$admin_query){
    	die("Database connection failed: " . mysqli_error($connection));
	}
	?>

		<div class="container ">
		<div class="mt-4" style="margin-top: 100px;">
			<div class="row">
				<div class="col-md-4 my-2">
					<div class="delAdmin-errorMesss"></div>
					<button class="btn btn-inline btn-primary" id="addAdminButton" data-toggle="modal" data-target="#addAdminModal">Add Admin</button>
					<button class="btn btn-secondary" id="deleteAdminButton"><span><img src="img/recycling-bin.svg" style="height: 30px; width: 30px;"></span></button>
					<!--Add User Modal -->
					<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div class="addAdmin-errorMesss" style="display: none;"></div>
                            <div class="addAdminProgress">
                            	<i class="fa fa-spinner fa-spin" id="addAdminSpinner"></i>
                                <label id="addAdminSpinnerLabel">Adding....</label>
                            </div>
					        <form>
					          <div class="row">
					          	<div class="form-group col">
						            <label for="recipient-name" class="col-form-label">First Name</label>
						            <input type="text" class="form-control" id="adminFirstName">
					          	</div>
					          	<div class="form-group col">
						            <label for="recipient-name" class="col-form-label">Last Name</label>
						            <input type="text" class="form-control" id="adminLastName">
					          	</div>
					          </div>
					          <div class="form-group">
					            <label for="message-text" class="col-form-label">Email</label>
					            <input type="text" class="form-control" id="adminEmail">
					          </div>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary" id="btnAddAdmin">Add</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!--Add User Modal -->
				</div>
				<div class="col-md-5 ml-auto my-2">
					<div class="form-group">
						<input type="text" id="search_admin" name="" class="form-control" style="height: 45px;" placeholder="Search Users">
						<!-- <button class="btn btn-primary form-inline" style="height: 45px;">Search</button> -->
					</div>
				</div>
			</div>
		</div>
		<div id="admin_table_div">
			<div id="adminHeadWord">
				<h6 id="adminLabel">Adminstrators</h6>
			</div>
            <table id="admin-table" class="table table-bordered table-hover">
                <thead>
                	<tr>
	                	<th id="admin_sel"></th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Edit</th>
                	</tr>
				</thead>
				<tbody id="tAdminBody">
	                 <?php 
						while ($user_row = mysqli_fetch_assoc($admin_query)) {
							$user_id = $user_row['user_id'];
							$full_name = $user_row['firstName'] ." " .$user_row['lastName'];
							$user_email = $user_row['email'];
						?>
	                <tr id="tr_<?= $user_id ?>">
	                	<td><input type="checkbox" name="<?php echo $user_id; ?>"></td>
	                    <td> <?php echo $full_name;?> </td>
	                    <td> <?php echo $user_email;?> </td>
	                    <td class="editTd"><button class="btn editAdminBtn" name="<?php echo $user_id; ?>" data-toggle="modal" data-target="#editAdminModal"><img src="img/edit.svg" class="editImg"></button></td>
	                    <?php                            
	                    }
	                    ?>
	                </tr>
            	</tbody>       
            </table>
            <!--Edit Administrators Details Modal -->
			<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Update Admin Info</h5>
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
				        	<input type="text" id="getAdminId" style="display: none;">
				          <div class="row">
				          	<div class="form-group col">
					            <label for="recipient-name" class="col-form-label">First Name</label>
					            <input type="text" class="form-control" id="editAdminFirstName">
				          	</div>
				          	<div class="form-group col">
					            <label for="recipient-name" class="col-form-label">Last Name</label>
					            <input type="text" class="form-control" id="editAdminLastName">
				          	</div>
				          </div>
				          <div class="form-group">
				            <label for="message-text" class="col-form-label">Email</label>
				            <input type="text" class="form-control" id="editAdminEmail">
				          </div>
				        </form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-sm btn-primary" id="updateAdminBtn">Update</button>
			      </div>
			    </div>
			  </div>
			</div>
			<!--Edit Administrators Details Modal -->
		</div>			
	</div>

</body>
</html>