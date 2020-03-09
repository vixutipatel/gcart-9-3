<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold">Oops...</span>
            </h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
            </li>
            <li class="active"><?php _el(get_current_controller()); ?></li>
        </ul>
    </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
    <div class="alert alert-danger alert-bordered">
        
        <span class="text-semibold">Oh snap!</span> <?php _el('access_denied'); ?>.
    </div>
</div>
<!-- /Content area -->
