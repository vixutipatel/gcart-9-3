<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold"><?php _el('roles'); ?></span>
            </h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">      
            <li>
                <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="icon-home2 position-left"></i><?php _el('dashboard'); ?></a>
            </li>
            <li class="active"><?php _el('roles'); ?></li>
        </ul>
    </div>
</div>
<!-- /Page header -->
<!-- Content area -->
<div class="content">
    <!-- Panel -->
    <div class="panel panel-flat">
        <?php if (has_permissions('roles','create')||has_permissions('roles','delete')) { ?>
        <!-- Panel heading -->
        <div class="panel-heading">
            <?php if (has_permissions('roles','create')) { ?>
                <a href="<?php echo base_url('admin/roles/add'); ?>" class="btn btn-primary"><?php _el('add_new'); ?><i class="icon-plus-circle2 position-right"></i></a>
            <?php } ?>
            <?php if (has_permissions('roles','delete')) { ?>
                <a href="javascript:delete_selected();" class="btn btn-danger" id="delete_all"><?php _el('delete_selected'); ?><i class=" icon-trash position-right"></i></a>
            <?php } ?>
        </div>
        <!-- /Panel heading -->
        <?php } ?>
        
        <!-- Listing table -->
        <div class="panel-body table-responsive">
            <table id="categories_table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <?php if (has_permissions('roles','delete')) { ?>
                        <th width="2%">
                            <input type="checkbox" name="select_all" id="select_all" class="styled" onclick="select_all(this);" >
                        </th>
                        <?php } ?>
                        <th width="90%"><?php _el('role_name'); ?></th>
                        <?php if (has_permissions('roles','edit') || has_permissions('roles','delete')) { ?>
                        <th width="8%" class="text-center"><?php _el('actions') ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $key => $role) { ?>
                    <tr>
                        <?php if (has_permissions('roles','delete')) { ?>
                        <td>
                            <input type="checkbox" class="checkbox styled"  name="delete"  id="<?php echo $role['id']; ?>">
                        </td>
                        <?php } ?>
                        <td><?php echo ucfirst($role['name']); ?></td>
                        <?php if (has_permissions('roles','edit') || has_permissions('roles','delete')) { ?>
                        <td class="text-center">
                            <?php if (has_permissions('roles','edit')) { ?>
                            <a data-popup="tooltip" data-placement="top"  title="<?php _el('edit') ?>" href="<?php echo site_url('admin/roles/edit/').$role['id']; ?>" id="<?php echo $role['id']; ?>" class="text-info">
                                <i class="icon-pencil7"></i>
                            </a>
                            <?php } ?>
                            <?php if (has_permissions('roles','delete')) { ?>
                            <a data-popup="tooltip" data-placement="top"  title="<?php _el('delete') ?>" href="javascript:delete_record(<?php echo $role['id']; ?>);" class="text-danger delete" id="<?php echo $role['id']; ?>">
                                <i class=" icon-trash"></i>
                            </a>
                            <?php } ?>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php } ?> 
                </tbody>
            </table>
           
        </div>
        <!-- /Listing table -->
    </div>
    <!-- /Panel -->       
</div>
<!-- /Content area -->

<script type="text/javascript">
$(function() {

    $('#categories_table').DataTable({
        'columnDefs': [{
        'targets': [0,2], /* column index */
        'orderable': false, /* disable sorting */
        }],
         
    });

    //add class to style style datatable select box
    $('div.dataTables_length select').addClass('datatable-select');
 });


var BASE_URL = "<?php echo base_url(); ?>";

/**
 * Deletes a single record when clicked on delete icon
 *
 * @param {int}  id  The identifier
 */
function delete_record(id) 
{         
    swal({
        title: "<?php _el('multiple_deletion_alert', _l('roles')); ?>",
        text: "<?php _el('multiple_recovery_alert', _l('roles')); ?>",
        type: "warning",    
        showCancelButton: true, 
        cancelButtonText:"<?php _el('no_cancel_it'); ?>",
        confirmButtonText: "<?php _el('yes_i_am_sure'); ?>",     
    },
    function()
    {
        $.ajax({
            url:BASE_URL+'admin/roles/delete',
            type: 'POST',
            data: {
                role_id:id
            },
            success: function(msg)
            {
                if (msg=="true")
                {                        
                    swal({                            
                        title: "<?php _el('_deleted_successfully', _l('role')); ?>",
                        type: "success",                            
                    });
                    $("#"+id).closest("tr").remove();
                }
                else
                {                        
                    swal({
                        title: "<?php _el('role_in_use_deletion_alert'); ?>", 
                        type: "error",                            
                    });
                }  
            }
        });
    });
}

/**
 * Deletes all the selected records when clicked on DELETE SELECTED button
 */
function delete_selected() 
{ 
    var role_ids = [];

    $(".checkbox:checked").each(function()
    {
        var id = $(this).attr('id');
        role_ids.push(id);
    });
    if (role_ids == '')
    {
        jGrowlAlert("<?php _el('select_before_delete_alert', _l('roles')) ?>", 'danger');
        preventDefault();
    }
    swal({
        title: "<?php _el('multiple_deletion_alert', _l('roles')); ?>",
        text: "<?php _el('multiple_recovery_alert', _l('roles')); ?>",
        type: "warning",  
        showCancelButton: true, 
        cancelButtonText:"<?php _el('no_cancel_it'); ?>",
        confirmButtonText: "<?php _el('yes_i_am_sure'); ?>",      
    },
    function()
    {
        $.ajax({
            url:BASE_URL+'admin/roles/delete_selected',
            type: 'POST',
            data: {
              ids:role_ids
            },
            success: function(msg)
            {
               var result = JSON.parse(msg);

               swal({                        
                    title: result.output,
                    html: true,                        
                    type: result.type,                        
                });

                $(result.deleted_role_ids).each(function(index, element) 
                  {
                      $("#"+element).closest("tr").remove();
                  });
            }
        });
    });
}

</script>
