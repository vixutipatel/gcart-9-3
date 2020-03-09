<table class="table table-bordered">
	<tr>
		<th width="40%"><?php _el('features'); ?></th>
		<th width="60%"><?php _el('capabilities'); ?></th>
	</tr>
	<?php 
	$checked = '';
	foreach ($permissions_data as $key=>$permission ) { ?>
	<tr>
		<th><?php echo $permission['name']; ?></th>
		<td>
			<?php foreach ($permission['capabilities'] as $index=>$capability) {
				$id = $key."_".$index;

				/*** for edit view ***/
				if(isset($role))
				{
					$role_permissions = unserialize($role['permissions']);
					if (isset($role_permissions[$key]) && in_array($index, $role_permissions[$key]))
					{
						$checked = 'checked';
					}  
					else 
					{
						$checked = '';
					}
				}
				/*** /for edit view ***/
			?>
			<div class="checkbox">
				<label for="<?php echo $id; ?>">
					<input type="checkbox" name="permissions[<?php echo $key; ?>][]" value="<?php echo $index; ?>" id="<?php echo $id; ?>" class="permission styled" <?php echo $checked; ?>>
					<?php echo $capability; ?> 
				</label>
			</div>
			<?php }	?>
		</td>
	</tr>
	<?php }	?>
</table>
