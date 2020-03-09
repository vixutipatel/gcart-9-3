<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('edit_role'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
			<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
			</li>
			<li>
				<a href="<?php echo base_url('admin/Roles'); ?>"><?php _el('roles'); ?></a>
			</li>
			<li class="active"><?php _el('edit'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
	<form method="POST" action="<?php echo base_url('admin/roles/edit/').$role['id']; ?>" id="roleform">
		<div class="row">
			<div class="col-md-6">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<h5 class="pull-left"><strong><?php _el('edit_role'); ?>: <?php echo $role['name']; ?></strong></h5>
								<?php if (has_permissions('roles','create')) { ?>
								<a href="<?php echo base_url('admin/roles/add'); ?>" class="btn btn-primary pull-right"><?php _el('add_new'); ?></a>
								<?php }	?>
							</div>											
						</div>
						<hr/>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="alert alert-warning alert-styled-left">
										<span><?php _el('edit_role_warning_alert'); ?></span>
									</div>
								</div>
								<div class="form-group">
									<small class="req text-danger">*</small>
									<label><?php _el('role_name'); ?>:</label>
									<input type="text" class="form-control" placeholder="<?php _el('role_name'); ?>" id="name" name="name" value="<?php echo $role['name']; ?>">
								</div>
								<div><?php echo $permissions; ?>
								</div>
								<div id="validation_msg"></div>
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</div>
			<div class="col-md-6">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<h5 class="panel-title">
							<strong><?php _el('users_using_role_msg'); ?>: <?php echo $role['name']; ?></strong>
						</h5>
						<hr/>
					</div>

					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<table id="users_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?php _el('name'); ?></th>
									<th><?php _el('email'); ?></th>
								</tr>	
							</thead>
							<tbody>
								<?php
								foreach ($users as $user) 
								{

								?>
								<tr>
									<td><?php echo ucfirst($user['firstname'])."&nbsp;". ucfirst($user['lastname']); ?></td>
									<td><a href="mailto:"><?php echo $user['email']; ?></a></td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</div>
		</div>
		<div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
		<button type="submit" class="btn btn-success" name="submit"><?php _el('save'); ?></button>
		<a class="btn btn-default" onclick="window.history.back();"><?php _el('back'); ?></a>
		</div>
	</form>
</div>
<!-- /Content area -->

<script type="text/javascript">
$(function() {

    $('#users_table').DataTable({
    	buttons: []
    });

    //add class to style style datatable select box
    $('div.dataTables_length select').addClass('datatable-select');
 });


$("#roleform").validate({
	rules: {
		name: {
			required: true,
		},
	},
	messages: {
		name: {
			required:"<?php echo _l('please_enter_', _l('role_name')) ?>",
		},
	}      
});  


function select_permissions() 
{ 
    var check_permission = $(".permission").serializeArray(); 
    if (check_permission.length === 0) 
    { 
         $("#validation_msg").html("<p style='color:red'><?php echo _l('please_select_some_role_permissions') ?></p>");
        return false;
    } 
}

$('#roleform').submit(select_permissions)
</script>

