<?php $this->load->view("AdminSidebar") ?>

<head>
	<title>Admin List</title>
	<link href=<?php echo base_url("assets/css/Admin.css")?> rel="stylesheet">

</head>
<main class="page-content">
	<div style="margin-left: 22%; width: 75%;">
		<div class="">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Admin List</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addAdminModal" class="btn btn-success" data-bs-toggle="modal"><i
								class="material-icons">&#xE147;</i> <span>Add New Admin</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Username</th>
						<th>Position</th>
						<th>Account Added</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach($admin as $row){?>
                        <tr>
                            <td><?php echo $row->firstname?> <?php echo $row->lastname?></td>
                            <td><?php echo $row->username?></td>
                            <td><?php echo $row->position?></td>
                            <td><?php echo date('m/d/Y', strtotime($row->dateAdded))?> at
			                    <?php echo date('h:i:s a', strtotime($row->timeAdded))?>
                            </td>
                            <td>
                                <a href="#editAdminModal" class="edit" data-bs-toggle="modal">
                                    <i class="material-icons edit_admin" data-id="<?php echo $row->adminID?>" data-bs-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" class="delete" data-bs-toggle="modal"><i class="material-icons delete_admin"
                                        data-bs-toggle="tooltip" data-id="<?php echo $row->adminID?>" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    <?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
	<!-- Add Modal HTML -->
	<div id="addAdminModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="<?php echo site_url('AdminFunctions/addAdmin')?>">
					<div class="modal-header">
						<h4 class="modal-title">Add Admin</h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" class="form-control" name="firstname" required>
						</div>
						<div class="form-group">
							<label>Lastname</label>
							<input type="text" class="form-control" name="lastname"  required>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" name="username"  required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="text" class="form-control"  name="password"  required>
						</div>
                        <div class="form-group">
							<label>Position at Company</label>
                            <select name="position" class="form-control" requred>
                                <option value="" selected hidden disabled>Please select</option>
                                <option value="Admin">Admin</option>
                                <option value="Secretary">Secretary</option>
                            </select>
						</div>
                        
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editAdminModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
                <div id="edit_admin">

                </div>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id="delete_admin">

                </div>
			</div>
		</div>
	</div>
</main>

<script src=<?php echo base_url("assets/js/Admin.js")?>></script>
<!-- jQuery JS CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jQuery DataTables JS CDN -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- Ajax fetching data -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').DataTable();
	
		$('.edit_admin').click(function () {
			var adminData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('AdminFunctions/editAdmin');?>",
				method: "POST",
				data: {
					adminData: adminData
				},
				success: function (data) {
					$('#edit_admin').html(data);
			
				}
			});
		});

        $('.delete_admin').click(function () {
			var adminData = $(this).data('id');
			$.ajax({
				url: "<?php echo site_url('AdminFunctions/delete');?>",
				method: "POST",
				data: {
					adminData: adminData
				},
				success: function (data) {
					$('#delete_admin').html(data);
				}
			});
		});
	});
</script>

