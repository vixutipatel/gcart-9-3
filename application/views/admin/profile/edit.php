<!-- Page header -->
<div class="page-header page-header-default">
  <div class="page-header-content">
    <div class="page-title">
      <h4>
      	<span class="text-semibold"><?php _el('edit_profile'); ?></span>
      </h4>
    </div>
  </div>
  <div class="breadcrumb-line">
    <ul class="breadcrumb">
			<li><a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a></li>			
			<li class="active"><?php _el('edit_profile'); ?></li>
		</ul>
  </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
	<div class="row">
		<!-- Left column -->
		<div class="col-md-7">
			<form action="<?php echo base_url('admin/profile/edit/') ?>" id="myprofileform" method="POST">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10">
							<h5 class="panel-title"><?php echo get_loggedin_info('username'); ?></h5>
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
									<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('lastname'); ?>:</label>
									<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('email'); ?>:</label>
									<input type="text" class="form-control"  id="email" name="email" class="email"value="<?php echo $user['email']; ?>">
								</div>	
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('contact_no'); ?>:</label>
									<input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $user['mobile_no']; ?>">
								</div>
								<div class="form-group" align="right">
									<button type="submit" class="btn btn-success" name="submit" id="save"><?php _el('save'); ?></button>
								</div>
							</div>
						</div>	
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</form>
		</div>
		<!-- /Left column -->
		<!-- Right column -->
		<div class="col-md-5">
			<form action="<?php echo base_url('admin/profile/edit_password/') ?>" id="mypasswordform" method="POST">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10">
								<h5 class="panel-title"><?php _el('change_password'); ?></h5>
							</div>
						</div>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<?php if(null!=$user['last_password_change']) { ?>
									<small><?php _el('last_password_change_msg', time_to_words($user['last_password_change'])) ?></small>
									<?php } ?>
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('old_password'); ?>:</label>
									<input type="password" name="old_password" class="form-control" id="old_password" autocomplete="off">								
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('new_password'); ?>:</label>
									<input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off">	
								</div>
								<div class="form-group">
									<small class="req text-danger">* </small>
									<label><?php _el('confirm_password'); ?>:</label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off">						
								</div>
								<div class="form-group" align="right">
									<button type="submit" class="btn btn-success" name="submit_password" id="submit_password"><?php _el('save'); ?></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</form>
		</div>
		<!-- /Right column -->
	</div>
</div>
<!-- /Content area -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<script type="text/javascript">

$("#myprofileform").validate(
{
    rules: 
    {
    	firstname: {
    		required: true,
    	},
    	lastname: {
    		required: true,
    	},
    	mobile_no: {
            required: true,
            number: true
        },
        email: {
            required: true,
            email: true
        },	      
    },
   	messages: 
   	{
    	firstname: {
            required:"<?php _el('please_enter_', _l('firstname')) ?>",
		},
        lastname: {
            required:"<?php _el('please_enter_', _l('lastname')) ?>",
        },
        mobile_no: {
            required:"<?php _el('please_enter_', _l('contact_no')) ?>",
            mobile_no:"Please Enter Digits"
	    },
        email: {
         	required:"<?php _el('please_enter_', _l('email')) ?>",
            email:"<?php _el('please_enter_valid_', _l('email')) ?>"
        },	      
    }	    
}); 

$.validator.addMethod("matcholdpassword", function(value, element) 
{
	var old_password = CryptoJS.MD5($(element).val());
	var user_password = "<?php  echo $user['password']; ?>";

	if (old_password == user_password)
		return true;
			
}, "<?php _el('incorrect_password') ?>");


$("#mypasswordform").validate({
	rules: {
		old_password: {
			required: true,
			matcholdpassword: true
		},
		new_password: {
			required: true,
			minlength: 8
		}, 
		confirm_password: {
			required: true,
			equalTo: "#new_password"
		},  
	},
	messages: {
		old_password: {
			required:"<?php _el('please_enter_',_l('old_password')) ?>",
		},
		new_password: {
			required:"<?php _el('please_enter_',_l('new_password')) ?>",
			minlength: "<?php _el('password_min_length_must_be_', 8) ?>"
		},
		confirm_password: {
			required:"<?php _el('please_enter_',_l('confirm_password')) ?>",
			equalTo: "<?php _el('conf_password_donot_match') ?>"
		},           
	}      
}); 

</script> 

