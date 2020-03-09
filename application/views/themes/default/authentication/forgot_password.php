<div class="container" style="margin-top:30px;">
    <?php $this->load->view('themes/default/includes/alerts');?>
    <div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class='active'>Forgot Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->
                <div class="col-md-4 col-md-offset-4 sign-in">
                <h4 class=""><?php _el('forgot_password');?></h4>
                <p class=""><?php _el('forgot_password_instructions');?></p>
                <form id="recovery_form" method="post" action="<?php echo site_url('authentication/forgot_password') ?>">
                <div class="form-group">
                    <label class="info-title" for="email"><?php _el('email');?> <span>*</span></label>
                    <input type="email" class="form-control unicase-form-control text-input" id="email" name="email" >
                 </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" name="submit"><?php _el('confirm');?></button>

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
$("#recovery_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required:"<?php _el('please_enter_', _l('email'))?>",
                email:"<?php _el('please_enter_valid_', _l('email'))?>"
            }
        }
    });
</script>
