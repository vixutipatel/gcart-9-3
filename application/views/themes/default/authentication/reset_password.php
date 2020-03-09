    <div class="container" style="margin-top:30px;">
    <?php $this->load->view('themes/default/includes/alerts');?>
    <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class='active'>Reset Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-4 col-md-offset-4">

                <h4 class="content-group"><?php _el('reset_password');?>?</h4>
                <form id="reset_form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

                <div class="form-group">
                    <label class="info-title" for="password"><?php _el('new_password');?> <span>*</span></label>
                    <input type="password" class="form-control unicase-form-control text-input" id="password" name="password" required>
                 </div>
                  <div class="form-group">
                    <label class="info-title" for="confirm_password"><?php _el('confirm_password');?> <span>*</span></label>
                    <input type="password" class="form-control unicase-form-control text-input" id="confirm_password" name="confirm_password" required>
                 </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit"><?php _el('reset_password');?></button>

                <a href="<?php echo site_url('authentication') ?>" style="float:right"><?php _el('login');?></a>

                </form>
                </div>
            </div>
        </div>
    <div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/core/libraries/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/forms/validation/validate.min.js'); ?>"></script>
<script type="text/javascript">
$("#reset_form").validate({
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages:{
            password: {
                required: "<?php _el('please_enter_', _l('password'))?>",
                minlength: "<?php _el('password_min_length_must_be_', 8)?>"
            },
            confirm_password: {
                required: "<?php _el('please_enter_', _l('confirm_password'))?>",
                equalTo: "<?php _el('conf_password_donot_match')?>"
            },
        }
    });
</script>
