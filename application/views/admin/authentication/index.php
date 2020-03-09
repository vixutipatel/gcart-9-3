<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $this->page_title; ?></title>
		<!-- Global stylesheets -->
		<link href="<?php echo base_url('assets/admin/css/icons/icomoon/styles.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/admin/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/admin/css/core.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/admin/css/components.css'); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url('assets/admin/css/colors.css'); ?>" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->
		
		<!-- Core JS files -->
		<script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/jquery.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/bootstrap.min.js'); ?>"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/validation/validate.min.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/styling/uniform.min.js'); ?>"></script>
		<!-- /theme JS files -->
		
		<script type="text/javascript">
		$.validator.setDefaults({
		  ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
		        errorClass: 'validation-error-label',
		        successClass: 'validation-valid-label',
		        highlight: function(element, errorClass) {
		            $(element).removeClass(errorClass);
		        },
		        unhighlight: function(element, errorClass) {
		            $(element).removeClass(errorClass);
		        },

		        // Different components require proper error label placement
		        errorPlacement: function(error, element) {

		            // Styled checkboxes, radios, bootstrap switch
		            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
		                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
		                    error.appendTo( element.parent().parent().parent().parent() );
		                }
		                 else {
		                    error.appendTo( element.parent().parent().parent().parent().parent() );
		                }
		            }

		            // Unstyled checkboxes, radios
		            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
		                error.appendTo( element.parent().parent().parent() );
		            }

		            // Input with icons and Select2
		            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
		                error.appendTo( element.parent() );
		            }

		            // Inline checkboxes, radios
		            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
		                error.appendTo( element.parent().parent() );
		            }

		            // Input group, styled file input
		            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
		                error.appendTo( element.parent().parent() );
		            }

		            else {
		                error.insertAfter(element);
		            }
		        },
		        validClass: "validation-valid-label",
		        success: function(label) {
		            label.addClass("validation-valid-label").text("")
		        },
		});
		$(function() {

			// Style checkboxes and radios
			$('.styled').uniform();

		});	
		</script>
	</head>
	<body class="login-container">
		<div class="page-container">
			<!-- Page content -->
			<div class="page-content">
				<!-- Main content -->
				<div class="content-wrapper">
					<!-- Content area -->
					<div class="content">
						<?php echo $content; ?>
						<!-- Footer -->
						<div class="footer text-muted text-center">
							&copy;<?php echo date('Y') ?>. Admin Panel by <a target="_blank">NISL</a>
						</div>
						<!-- /footer -->
					</div>
					<!-- /content area -->
				</div>
				<!-- /main content -->
			</div>
			<!-- /page content -->
		</div>
		<!-- /page container -->
	</body>
</html>