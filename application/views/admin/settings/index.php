<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4></i> <span class="text-semibold"><?php _el('settings'); ?></span></h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
			</li>
			<li class="active"><?php _el('settings'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
	<form action="" method="POST" id="settings_form" name="settings_form">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel body -->
					<div class="panel-body">
						<div class="tabbable nav-tabs-vertical nav-tabs-left">
							<ul class="nav nav-tabs nav-tabs-highlight">
								<li class="active">
									<a href="#group-general" data-toggle="tab"><?php _el('company_info'); ?></a>
								</li>
								<li>
									<a href="#group-date-time" data-toggle="tab"><?php _el('date_time'); ?></a>
								</li>
								<li>
									<a href="#group-social-media" data-toggle="tab"><?php _el('social_media'); ?></a>
								</li>
								<li>
									<a href="#group-dummy-1" data-toggle="tab"><?php _el('email'); ?></a>
								</li>
								<li>
									<a href="#group-dummy-2" data-toggle="tab"><?php _el('general'); ?></a>
								</li>
							</ul>
							<div class="tab-content">
								<!-- tab pane for group-company-info -->
								<div class="tab-pane active has-padding" id="group-general">
									<div class="form-group ">										
										<label><?php _el('company_name'); ?>:</label>
										<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo get_settings('company_name'); ?>" >
									</div>
									<div class="form-group ">										
										<label><?php _el('company_email'); ?>:</label>
										<input type="email" name="company_email" id="company_email" class="form-control" value="<?php echo get_settings('company_email'); ?>" >
									</div>									
								</div>
								<!-- /tab pane for group-company-info -->
								<!-- tab pane for group-date-time -->
								<div class="tab-pane has-padding" id="group-date-time">
									<div class="form-group ">
										<label>Date Format:</label>
										<select class="select" name="date_format" id="role">
											<option value="j-M-Y" <?php echo (get_settings('date_format')=="j-M-Y")? "selected" : " "; ?>>
												<?php echo date("j-M-Y"); ?>
											</option>
											<option value="j-m-Y" <?php echo (get_settings('date_format')=="j-m-Y")? "selected" : " "; ?>>
												<?php echo date("j-m-Y"); ?>
											</option>
											<option value="jS F, Y" <?php echo (get_settings('date_format')=="jS F, Y")? "selected" : " "; ?>>
												<?php echo date("jS F, Y"); ?>
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Time Format:</label>
										<select class="select" name="time_format" >
											<option value="h:i A" <?php echo (get_settings('time_format')=="h:i A")? "selected" : " "; ?>>02:30 PM (12 hours)</option>
											<option value="H:i" <?php echo (get_settings('time_format')=="H:i")? "selected" : " "; ?>>14:30 (24 hours)</option>
										</select>
									</div>
								</div>
								<!-- /tab pane for group-date-time -->
								<!-- tab pane for group-social-media -->
								<div class="tab-pane has-padding" id="group-social-media">
									<div class="form-group has-feedback has-feedback-left">
										<label>Facebook URL:</label>
										<input type="url" class="form-control" name="facebook_url" id="facebook_url" value="<?php echo get_settings('facebook_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-facebook2"></i>
										</div>
									</div>
									<div class="form-group has-feedback has-feedback-left">
										<label>Twitter URL:</label>
										<input type="url" class="form-control" name="twitter_url" id="twitter_url" value="<?php echo get_settings('twitter_url'); ?>">
										<div class="form-control-feedback">
											<i class="icon-twitter2"></i>
										</div>
									</div>
								</div>
								<!-- /tab pane for group-social-media -->
								<!-- tab pane for group-email -->
								<div class="tab-pane has-padding" id="group-dummy-1">									
									<div class="form-group">
										<label>SMTP Host:</label>
										<input type="text" name="smtp_host" id="smtp_host" class="form-control" value="<?php echo get_settings('smtp_host'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Port:</label>
										<input type="number" name="smtp_port" id="smtp_port" class="form-control" value="<?php echo get_settings('smtp_port'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Encryption:</label>										
										<select class="select" name="smtp_encryption" id="smtp_encryption">
                            				<option value="ssl" <?php if(get_settings('smtp_encryption')=='ssl') echo 'selected'; ?>>SSL</option>
                            				<option value="tls" <?php if(get_settings('smtp_encryption')=='tls') echo 'selected'; ?>>TLS</option>
                            			</select>
									</div>
									<div class="form-group">
										<label>SMTP User:</label>
										<input type="text" name="smtp_user" id="smtp_user" class="form-control" value="<?php echo get_settings('smtp_user'); ?>">
									</div>
									<div class="form-group">
										<label>SMTP Password:</label>
										<input type="text" name="smtp_password" id="smtp_password" class="form-control" value="<?php echo get_settings('smtp_password'); ?>">
									</div>									
									<div class="form-group">
										<label>From Name:</label>
										<input type="text" name="from_name" id="from_name" class="form-control" value="<?php echo get_settings('from_name'); ?>">
									</div>
									<div class="form-group">
										<label>Reply to Email:</label>
										<input type="email" name="reply_to_email" id="reply_to_email" class="form-control" value="<?php echo get_settings('reply_to_email'); ?>">
									</div>
									<div class="form-group">
										<label>Reply to Name:</label>
										<input type="text" name="reply_to_name" id="reply_to_name" class="form-control" value="<?php echo get_settings('reply_to_name'); ?>">
									</div>
									<div class="form-group">
										<label>BCC All Emails to:</label>
										<input type="email" name="bcc_emails_to" id="bcc_emails_to" class="form-control" value="<?php echo get_settings('bcc_emails_to'); ?>">
									</div>
									<div class="form-group">
										<label>Email Signature:</label>
										<textarea name="email_signature" id="email_signature" rows="4" class="form-control"><?php echo get_settings('email_signature'); ?></textarea>
									</div>
									<div class="form-group">
										<label>Email Header:</label>
										<textarea name="email_header" id="email_header" rows="8" class="form-control" placeholder="Common Email Header in HTML format"><?php echo get_settings('email_header'); ?></textarea>
									</div>
									<div class="form-group">
										<label>Email Footer:</label>
										<textarea name="email_footer" id="email_footer" rows="8" class="form-control" placeholder="Common Email Footer in HTML format"><?php echo get_settings('email_footer'); ?></textarea>
									</div>	
									<hr/>
									<h5>Send Test Email</h5>
									<p class="text-muted">Send test email to make sure that your SMTP settings are set correctly.</p>
									<div class="form-group">
										<div class="input-group">										
										<input type="email" id="test_email" class="form-control" placeholder="Email Address">
										<div class="input-group-btn">
											<button type="button" class="btn btn-default test_email">Test</button>
										</div>
										</div>	
									</div>									
								</div>
								<!-- /tab pane for group-email -->
								<!-- tab pane for group-general -->
								<div class="tab-pane has-padding" id="group-dummy-2">
									<div class="form-group">
										<label><?php _el('log_activity'); ?> ?:</label>										
										<br>
										<input type="hidden" name="log_activity" value="0" />
										<input type="checkbox" name="log_activity" id="log_activity" value="1" class="switchery form-control" <?php if( get_settings('log_activity') == 1 ) echo 'checked'; ?> >
									</div>																	
								</div>
								<!-- /tab pane for group-general -->
							</div>
						</div>
					</div>
					<!-- /Panel body -->
				</div>
				<!-- /Panel -->
			</div>
		</div>			
		<div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
			<button type="submit" class="btn btn-success"><?php _el('save');?> <?php _el('settings') ?></button>			
		</div>
	</form>
</div>
<!-- /Content area -->

<script type="text/javascript">

var BASE_URL = "<?php echo base_url(); ?>";

$( "#settings_form" ).on( "submit", function( event ) {

	event.preventDefault();

	$.ajax({
		url:BASE_URL+'admin/settings/add',
		type: 'POST',
		data: $(this).serialize(),
		success: function(msg)
		{ 
			if (msg=='true')
            {                           
                jGrowlAlert("<?php _el('_updated_successfully', _l('settings')); ?>", 'success');
            }
		}
	});
});

$('.test_email').on('click', function() {
      var email = $('#test_email').val();
      if (email != '') {
       $(this).attr('disabled', true);
       $.post(BASE_URL+'admin/settings/send_smtp_test_email', {
        test_email: email
      }).done(function(msg) {
        	if (msg=='true')
            {                           
                jGrowlAlert('Seems like your SMTP settings are set correctly. Check your email now.', 'success');
            }
            else
            {
            	jGrowlAlert('Seems like your SMTP settings are not set correctly. Please check again.', 'danger');
            }
            $('.test_email').removeAttr('disabled');
            $('#test_email').val('');
      });
    }
  });

</script>