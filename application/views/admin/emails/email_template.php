<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4>
				<span class="text-semibold">Edit Email Template</span>
			</h4>
		</div>
	</div>
	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>	
			</li>
			<li>
				<a href="<?php echo base_url('admin/emails'); ?>">Email Templates</a>
			</li>
			<li class="active"><?php _el('edit'); ?></li>
		</ul>
	</div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
	<form action="<?php echo base_url('admin/emails/email_template/').$template['id']; ?>" id="templateform" method="POST">
		<div class="row">
			<div class="col-md-6">
				<!-- Panel -->
				<div class="panel panel-flat">
					<!-- Panel heading -->
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<h5 class="panel-title">
									<strong>Edit Temaplate: <?php echo $template['name']; ?></strong>
								</h5>
								<hr/>
							</div>
						</div>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">									
									<label><?php _el('name'); ?>:</label>
									<input type="text" class="form-control" readonly="readonly" data-popup="tooltip" title="Can not change template name" data-placement="top" value="<?php echo $template['name']; ?>">
								</div>
								<div class="form-group">					
									<label>Slug:</label>
									<input type="text" class="form-control" readonly="readonly" data-popup="tooltip" title="Can not change template slug" data-placement="top" value="<?php echo $template['slug']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">*</small>						
									<label>Subject:</label>
									<input type="text" class="form-control" placeholder="Subject" id="subject" name="subject" value="<?php echo $template['subject']; ?>">
								</div>
								<div class="form-group">
									<small class="req text-danger">*</small>						
									<label>Message Body:</label>
									<textarea name="message" id="message" class="form-control summernote" rows="10"><?php echo $template['message']; ?></textarea>
									<div id="validation_msg"></div>
								</div>
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
							<strong>Available Placeholders for this template</strong>
						</h5>
						<hr/>
					</div>
					<!-- /Panel heading -->
					<!-- Panel body -->
					<div class="panel-body">
						<div class="well">
				                    <dl class="dl-horizontal">
					                    <?php 
					                    $placeholders = unserialize($template['placeholders']);
					                    asort($placeholders);
					                    foreach ($placeholders as $key => $value) 
					                    	{					                    	
					                    ?>
											<dt><?php echo $value; ?></dt>
											<dd><a data-popup="tooltip" title="Click to add" data-placement="top" href="javascript:void(0);" class="copy"><?php echo $key; ?></a></dd>											
										<?php } ?>
									</dl>
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

$('.summernote').summernote({
        height: 350
});

$('.copy').on('click', function(e){
	e.preventDefault();	
	$('.summernote').summernote('editor.insertText', $(this).text());

});

$('#templateform').on('submit', function() {
    if($('.summernote').summernote('isEmpty'))
    {
    	$("#validation_msg").html("<p style='color:red'>Please Enter Template Message.</p>");
    	return false;
    }
    return true;
});

$("#templateform").validate({
	rules: {
		subject:{
			required: true,
		},
	},
	messages: {
		subject:{
			required: 'Please Enter Template Subject',
		},
	},	
});  
</script>

