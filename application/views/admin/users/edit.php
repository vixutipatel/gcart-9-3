<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold"><?php _el('edit_user'); ?></span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
			</li>
			<li>
				<a href="<?php echo base_url('admin/users'); ?>"><?php _el('users'); ?></a>
			</li>
			<li class="active"><?php _el('edit'); ?></li>
		</ul>
	</div>
</div>
<!-- Page header -->
<!-- Content area -->
<div class="content">	
	<form action="<?php echo base_url('admin/users/edit/').$user['id']; ?>" id="profileform" method="POST">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10">
								<h5 class="panel-title">
									<strong><?php _el('user'); ?></strong>
								</h5>
							</div>
						</div>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('firstname'); ?>:</label>
									<input type="text" class="form-control" placeholder="<?php _el('firstname'); ?>" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('lastname'); ?>:</label>
									<input type="text" class="form-control" placeholder="<?php _el('lastname'); ?>" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('email'); ?>:</label>
									<input type="text" class="form-control" placeholder="<?php _el('email'); ?>" id="email" name="email" class="email"value="<?php echo $user['email']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('mobile_no'); ?>:</label>
									<input type="text" class="form-control" placeholder="<?php _el('mobile_no'); ?>" id="mobile_no" name="mobile_no" value="<?php echo $user['mobile_no']; ?>">
								</div>
								<div class="form-group">							
									<label><?php _el('new_password'); ?>:</label>
									<input type="password" class="form-control" placeholder="<?php _el('enter_new_password_only_if_you_want_to_change_password'); ?>" id="newpassword" name="newpassword" value="" >											
								</div>
								<div class="form-group">
									<label><?php _el('status'); ?>:</label>
									<?php 
									$readonly = '';
									if ($user['id']==get_loggedin_user_id()){
										$readonly="readonly";
									} 
									?> 
									<input type="checkbox" class="switchery" name="is_active" 
									id="<?php echo $user['id']; ?>" <?php if($user['is_active']==1) { echo "checked";} ?>  <?php  echo $readonly; ?> >
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('role'); ?></label>
									<select class="select" name="role" id="role">
										<?php foreach ($roles as $key => $role) { ?>									
										<option value="<?php echo $role['id']; ?>" name="role" <?php if($user['role']==$role['id']){ echo  "selected";}?>><?php echo $role['name'] ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
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
function isPasswordPresent() {
	return $('#newpassword').val().length > 0;
}

$("#profileform").validate({
	rules: {
		firstname: {
			required: true,
		},
		lastname: {
			required: true,
		},
		mobile_no: {
			required: true,
            number: true,
            minlength:10,
		},
		email: {
			required: true,
			email: true
		},
		newpassword: {            
            minlength: {
                depends: isPasswordPresent,
                param: 8
            }
        },
		role: {
			required: true
		}
	},
	messages: {
		firstname: {
			 required:"<?php _el('please_enter_', _l('firstname')) ?>",
		},
		lastname: {
			required:"<?php _el('please_enter_', _l('lastname')) ?>",
		},
		mobile_no: 'Please enter a valid 10 digit mobile number',
		email: {
			required:"<?php _el('please_enter_', _l('email')) ?>",
            email:"<?php _el('please_enter_valid_', _l('email')) ?>",
		},
		newpassword: {
			minlength: "<?php _el('password_min_length_must_be_', 8) ?>",
		},
		role: {
			required:"<?php _el('please_select_', _l('role')) ?>",
		},
	}
});  

</script>

