<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold"><?php _el('add_user'); ?></span>
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
            <li class="active"><?php _el('add'); ?></li>
        </ul>
    </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
    <form action="<?php echo base_url('admin/users/add'); ?>" id="userform" method="POST">
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
                                <input type="text" class="form-control" placeholder="<?php _el('firstname'); ?>" id="firstname" name="firstname">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('lastname'); ?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('lastname'); ?>" id="lastname" name="lastname">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('email'); ?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('email'); ?>" id="email" name="email" class="email">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('mobile_no'); ?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('mobile_no'); ?>" id="mobile_no" name="mobile_no">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('password'); ?>:</label>
                                <input type="password" class="form-control" placeholder="<?php _el('password'); ?>" id="password" name="password" >
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('confirm_password'); ?>:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="<?php _el('confirm_password'); ?>">
                            </div>
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label><?php _el('role'); ?></label>
                                <select class="select" name="role" id="role">
                                    <option value=""><?php _el('please_select_', _l('role')); ?></option>
                                    <?php 
                                    foreach ($roles as $key => $role){ ?>
                                    <option value="<?php echo $role['id']; ?>" name="role"><?php echo $role['name']; ?></option>
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
var BASE_URL = "<?php echo base_url(); ?>";

$.validator.addMethod("emailExists", function(value, element) 
{
    var mail_id = $(element).val();
    var ret_val = '';
    $.ajax({
        url:BASE_URL+'admin/authentication/email_exists',
        type: 'POST',
        data: { email: mail_id },
        async: false,
        success: function(msg) 
        {   
            if(msg==1)
            {
                ret_val = false;
            }
            else
            {
                ret_val = true;
            }
        }
    }); 

    return ret_val;
            
}, "<?php _el('email_exists') ?>");

$("#userform").validate({
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
            email: true,
            emailExists: true,
        },
        password: {
            required: true,
            minlength: 8
        },
        confirm_password: {
            required: true,
            equalTo: "#password",
        },
        role: {
            required: true,
        },
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
            email:"<?php _el('please_enter_valid_', _l('email')) ?>"
        },        
        password: {
            required:"<?php _el('please_enter_', _l('password')) ?>",
            minlength: "<?php _el('password_min_length_must_be_', 8) ?>",
        },
        confirm_password: {
            required:"<?php _el('please_enter_', _l('password')) ?>",
            equalTo: "<?php _el('conf_password_donot_match') ?>",
        }, 
        role: {
            required:"<?php _el('please_select_', _l('role')) ?>",
        },
    },
}); 
    	
</script>
