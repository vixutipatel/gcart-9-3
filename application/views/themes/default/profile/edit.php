<div class="container" style="margin-top:30px;">
    <?php $this->load->view('themes/default/includes/alerts');?>
    <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class='active'><?php _el('edit_profile');?></li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
<?php
	//var_dump($user);

	foreach ($user as $user)
	{
	}

?>
	<div class="col-md-6 col-sm-6 sign-in">
		<h4 class=""><?php _el('edit_profile');?></h4>
    	<p class="">Hello, Welcome to your account.</p>

		<form action="<?php echo base_url('profile/edit') ?>" id="myprofileform" method="POST"  class="register-form outer-top-xs" role="form">

		<div class="form-group">
            <label class="info-title" for="firstname"><?php _el('firstname');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
        </div>
         <div class="form-group">
            <label class="info-title" for="lastname"><?php _el('lastname');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="lastname" name="lastname"  value="<?php echo $user['lastname']; ?>">
        </div>
        <div class="form-group">
            <label class="info-title" for="mobile"><?php _el('mobile_no');?> <span>*</span></label>
            <input type="text" class="form-control unicase-form-control text-input" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" >
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail2"><?php _el('email');?> <span>*</span></label>
            <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2" name="email" value="<?php echo $user['email']; ?>">
        </div>
         <div class="form-group">
            <label class="info-title" for="address_1"><?php _el('address_1');?></label>
            <input type="text" class="form-control unicase-form-control text-input" id="address_1" name="address_1" value="<?php echo $user['address_1']; ?>">
        </div>
        <div class="form-group">
            <label class="info-title" for="address_2"><?php _el('address_2');?></label>
            <input type="text" class="form-control unicase-form-control text-input" id="address_2" name="address_2" value="<?php echo $user['address_2']; ?>">
        </div>
         <div class="form-group">
            <label class="info-title" for="city"><?php _el('city');?></label>
            <input type="text" class="form-control unicase-form-control text-input" id="city"  name="city" value="<?php echo $user['city']; ?>">
        </div>
		<div class="form-group">
            <label class="info-title" for="state"><?php _el('state');?></label>
            <input type="text" class="form-control unicase-form-control text-input" id="state"  name="state" value="<?php echo $user['state']; ?>">
        </div>
		<div class="form-group">
            <label class="info-title" for="pin_code"><?php _el('pin_code');?></label>
            <input type="text" class="form-control unicase-form-control text-input" id="pincode"  name="pincode" value="<?php echo $user['pincode']; ?>">
        </div>
        <button type="submit" id='save' name="submit" value="Upload Image" class="btn-upper btn btn-success checkout-page-button"><?php _el('update')?></button>

			</form>
		</div>
		<div class="col-md-6 col-sm-6 sign-in">
			<h4 class=""><?php _el('change_password');?></h4>
			<p class="">
				<?php

					if (null != $user['last_password_change'])
					{
					?>
<?php _el('last_password_change_msg', time_to_words($user['last_password_change']))?>
<?php }

?>
		    </p>

			<form action="<?php echo base_url('profile/edit_password') ?>" id="mypasswordform" method="POST"  class="register-form outer-top-xs" role="form">

			<div class="form-group">
            	<label class="info-title" for="old_password"><?php _el('old_password');?><span>*</span></label>
           		<input type="password" class="form-control unicase-form-control text-input" id="old_password" name="old_password" autocomplete="off" >
        	</div>
			<div class="form-group">
            	<label class="info-title" for="new_password"><?php _el('new_password');?><span>*</span></label>
           		<input type="password" class="form-control unicase-form-control text-input" id="new_password" name="new_password" autocomplete="off" >
       		</div>
        	<div class="form-group">
            	<label class="info-title" for="confirm_password"><?php _el('confirm_password');?><span>*</span></label>
           		<input type="password" class="form-control unicase-form-control text-input" id="confirm_password"  name="confirm_password" autocomplete="off">
        	</div>
         	<button type="submit" id='submit_password' name="submit_password" class="btn-upper btn btn-success checkout-page-button"><?php _el('update')?></button>

			</form>

			<br><br>
			<!--change profile image-->
			<h4 class=""><?php _el('profile_image');?></h4>
			<p class=""></p>
			<div class="form-group">

			<form method="post" id="upload_image" class="register-form outer-top-xs"  action="<?php echo base_url('profile/uploads') ?>" enctype="multipart/form-data" role="form" enctype="multipart/form-data">
				<div class="form-group">
				<label class="info-title" for="profile_image"><?php _el('profile_image');?> </label>

			    <img class="img-circle" id="blah" src="<?php echo base_url() ?><?php echo $user['profile_image']; ?>" alt="<?php _el('profile_image');?>" height=64 width=100 />
	            <input type="file" class="form-control unicase-form-control text-input" id="profile_image" name="profile_image" size="33" />
	        	</div>
	            <button type="submit" value="Upload Image" class="btn-upper btn btn-success checkout-page-button"><?php _el('update')?></button>

            </form>
        </div>
		</div>

	</div>
</div>
<!-- /Content area -->
</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/validation/additional_methods.min.js'); ?>"></script>
<script type="text/javascript">
$("#myprofileform").validate({
    rules:
    {
    	firstname: {
    		required: true,
    	},
    	lastname: {
    		required: true,
    	},
    	mobile: {
            required: true,
            number: true,
            minlength:10
        },
        email: {
            required: true,
            email: true
        },
        address_1:{
            required: true,
        },
        address_2:{
            required: true,
        },
        city: {
    		required: true,
    	},
    	state: {
    		required: true,
    	},
    	pincode: {
    		required: true,
    		number: true,
    		maxlength:6


    	},

    },
   	messages:
   	{
    	firstname: {
            required:"<?php _el('please_enter_', _l('firstname'))?>",
		},
        lastname: {
            required:"<?php _el('please_enter_', _l('lastname'))?>",
        },
        mobile: {
            required:"<?php _el('please_enter_', _l('contact_no'))?>",
            mobile:"Please Enter Digits",
            minlength :'Please enter a valid 10 digit mobile number',

	    },
        email: {
         	required:"<?php _el('please_enter_', _l('email'))?>",
            email:"<?php _el('please_enter_valid_', _l('email'))?>"
        },
        address_1: {
            required:"<?php _el('please_enter_', _l('address_1'))?>",
		},
		address_2: {
            required:"<?php _el('please_enter_', _l('address_2'))?>",
		},
		city: {
            required:"<?php _el('please_enter_', _l('city'))?>",
		},
		state: {
            required:"<?php _el('please_enter_', _l('state'))?>",
		},
		pincode: {
            required:"<?php _el('please_enter_', _l('pin_code'))?>",
            pincode:"Please Enter Digits",
            maxlength :'Please enter a valid length',


		},

    }
});

$.validator.addMethod("matcholdpassword", function(value, element)
{
	var old_password = CryptoJS.MD5($(element).val());
	var user_password = "<?php echo $user['password']; ?>";

	if (old_password == user_password)
		return true;

}, "<?php _el('incorrect_password')?>");


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
			required:"<?php _el('please_enter_', _l('old_password'))?>",
		},
		new_password: {
			required:"<?php _el('please_enter_', _l('new_password'))?>",
			minlength: "<?php _el('password_min_length_must_be_', 8)?>"
		},
		confirm_password: {
			required:"<?php _el('please_enter_', _l('confirm_password'))?>",
			equalTo: "<?php _el('conf_password_donot_match')?>"
		},
	}
});


$("#upload_image").validate({
	rules: {
		profile_image: {
			required: true,
			extension:"jpeg,png",
		},

	},
	messages: {
		profile_image: {
			required:"<?php _el('please_enter_', _l('profile_image'))?>",
			extension:"<?php _el('please_enter_valid_', _l('profile_image'))?>"
		},

	}
});

</script>

