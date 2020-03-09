<div class="container" style="margin-top:30px;">
    <?php $this->load->view('themes/default/includes/alerts');?>
    <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
<div class="col-md-6 col-sm-6 sign-in">
    <h4 class="">Sign in</h4>
    <p class="">Hello, Welcome to your account.</p>

    <form id="login_form" method="post" action="<?php echo site_url('authentication'); ?>" class="register-form outer-top-xs" role="form">
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1"><?php _el('email');?> <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" name="email" >
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputPassword1"><?php _el('password');?><span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" name="password">
        </div>
        <div class="radio outer-xs">
            <label class="checkbox-inline">
                 <input type="checkbox" class="styled" name="remember"  id="remember" value="remember" >
                        <?php _el('remember_me')?>
            </label>
            <a href="<?php echo site_url('authentication/forgot_password'); ?>" class="forgot-password pull-right"><?php _el('forgot_password')?></a>
        </div>
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button"><?php _el('login')?></button>
    </form>
</div>

<!-- Sign-in -->

<!-- create a new account -->
<div class="col-md-6 col-sm-6 create-new-account">
    <h4 class="checkout-subtitle">Create a new account</h4>
    <p class="text title-tag-line">Create your new account.</p>
    <form id="signup_form" method="post" action="<?php echo site_url('authentication/signup') ?>" class="register-form outer-top-xs" role="form">

        <div class="form-group">
            <label class="info-title" for="firstname"><?php _el('firstname');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="firstname" name="firstname" >
        </div>
         <div class="form-group">
            <label class="info-title" for="lastname"><?php _el('lastname');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="lastname" name="lastname" >
        </div>
        <div class="form-group">
            <label class="info-title" for="mobile"><?php _el('mobile_no');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="mobile" name="mobile" >
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail2"><?php _el('email');?> <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" >
        </div>

        <div class="form-group">
            <label class="info-title" for="password"><?php _el('password');?><span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" >
        </div>
         <div class="form-group">
            <label class="info-title" for="confirm_password"><?php _el('confirm_password');?><span>*</span></label>
            <input type="password" class="form-control unicase-form-control text-input" id="confirm_password"  name="confirm_password">
        </div>
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button"><?php _el('signup')?></button>
    </form>

</div>
            </div> <!--row-->
        </div><!--sign-in-page-->
    </div>
</div><!--body-content-->
</div><!--container-->


<script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script type="text/javascript">

var BASE_URL = "<?php echo base_url(); ?>";

$.validator.addMethod("emailExists", function(value, element)
{
    var mail_id = $(element).val();
    var ret_val = '';
    $.ajax({
        url:BASE_URL+'authentication/email_exists',
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

}, "<?php _el('email_exists')?>");

$("#signup_form").validate({
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        mobile: {
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
            required:"<?php _el('please_enter_', _l('firstname'))?>",
        },
        lastname: {
            required:"<?php _el('please_enter_', _l('lastname'))?>",
        },
        mobile_no: {
            required:"<?php _el('please_enter_', _l('mobile_no'))?>",
            minlength :'Please enter a valid 10 digit mobile number',
       },
        email: {
            required:"<?php _el('please_enter_', _l('email'))?>",
            email:"<?php _el('please_enter_valid_', _l('email'))?>"
        },
        password: {
            required:"<?php _el('please_enter_', _l('password'))?>",
            minlength: "<?php _el('password_min_length_must_be_', 8)?>",
        },
        confirm_password: {
            required:"<?php _el('please_enter_', _l('password'))?>",
            equalTo: "<?php _el('conf_password_donot_match')?>",
        },
        role: {
            required:"<?php _el('please_select_', _l('role'))?>",
        },
    },
});

$("#login_form").validate
    ({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required:"<?php _el('please_enter_', _l('email'))?>",
                email:"<?php _el('please_enter_valid_', _l('email'))?>"
            },
            password: {
                required:"<?php _el('please_enter_', _l('password'))?>"
            },
        }
    });

</script>
