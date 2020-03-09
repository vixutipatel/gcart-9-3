<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('role_model', 'roles');
		$this->load->model('user_model', 'users');
		$this->load->model('user_permission_model', 'user_permissions');
	}

	/**
	 * Loads the list of roles.
	 */
	public function index()
	{
		$this->set_page_title(_l('roles'));

		if (!has_permissions('roles', 'view'))
		{
			$this->access_denied('roles', 'view');
		}
		else
		{
			$data['roles']   = $this->roles->get_all();
			$data['content'] = $this->load->view('admin/roles/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/**
	 * Adds new role
	 */
	public function add()
	{
		$this->set_page_title(_l('roles').' | '._l('add'));

		if (!has_permissions('roles', 'create'))
		{
			$this->access_denied('roles', 'create');
		}
		else
		{
			$data['permissions_data'] = $this->default_permissions();
			$data['permissions']      = $this->load->view('admin/roles/permissions', $data, TRUE);
			$data['content']          = $this->load->view('admin/roles/create', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);

			if ($this->input->post())
			{
				$data = array(
					'name'        => $this->input->post('name'),
					'permissions' => serialize($this->input->post('permissions'))
				);

				$insert = $this->roles->insert($data);

				if ($insert)
				{
					log_activity("New Role Created [ID: $insert]");
					set_alert('success', _l('_added_successfully', _l('role')));
					redirect('admin/roles');
				}
			}
		}
	}

	/**
	 * Updates the role record
	 *
	 * @param int  $id  The role id
	 */
	public function edit($id = '')
	{
		$this->set_page_title(_l('roles').' | '._l('edit'));

		if (!has_permissions('roles', 'edit'))
		{
			$this->access_denied('roles', 'edit');
		}
		else

		if ($id)
		{
			if ($this->input->post())
			{
				$data = array(
					'name'        => $this->input->post('name'),
					'permissions' => serialize($this->input->post('permissions'))
				);
				$update = $this->roles->update($id, $data);

				$users = $this->users->get_many_by(array('role' => $id));

				if ($users != null)
				{
					$user_id_array = array();

					foreach ($users as $key => $value)
					{
						$user_id = $value['id'];
						array_push($user_id_array, $user_id);
					}

					$delete_prmissions = $this->user_permissions->delete_by(array('user_id' => $user_id_array));
					$roles             = $this->roles->get($id);
					$permissions       = unserialize($roles['permissions']);

					foreach ($permissions as $key => $permission)
					{
						foreach ($permission as $key_permission => $value)
						{
							foreach ($user_id_array as $key_user_id => $user)
							{
								$data = array
									(
									'user_id'      => $user,
									'features'     => $key,
									'capabilities' => $value
								);
								$user_permissions_insert = $this->user_permissions->insert($data);
							}
						}
					}
				}

				if ($update)
				{
					set_alert('success', _l('_updated_successfully', _l('role')));
					log_activity("Role Updated [ID: $id]");
					redirect('admin/roles');
				}
			}

			$data['role']             = $this->roles->get($id);
			$data['permissions_data'] = $this->default_permissions();

			$this->users->order_by('firstname');
			$data['users']       = $this->users->get_many_by(['role' => $id]);
			$data['permissions'] = $this->load->view('admin/roles/permissions', $data, TRUE);
			$data['content']     = $this->load->view('admin/roles/edit', $data, TRUE);

			$this->load->view('admin/layouts/index', $data);
		}
		else
		{
			redirect('admin/roles');
		}
	}

	/**
	 * Deletes the single role record
	 */
	public function delete()
	{
		$role_id = $this->input->post('role_id');
		$users   = $this->users->get_many_by(array('role' => $role_id));

		if (empty($users))
		{
			$result = $this->roles->delete($role_id);
			log_activity("Role Deleted [ID: $role_id]");
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}

	/**
	 * Deletes multiple role records
	 */
	public function delete_selected()
	{
		$roles                  = $this->input->post('ids');
		$deleted_role_ids       = array();
		$deleted_role_names     = array();
		$not_deleted_role_names = array();
		$output                 = '';

		foreach ($roles as $role)
		{
			$users = $this->users->get_many_by(array('role' => $role));

			if (empty($users))
			{
				array_push($deleted_role_ids, $role);
				array_push($deleted_role_names, get_role_by_id($role));
				$result = $this->roles->delete($role);
			}
			else
			{
				array_push($not_deleted_role_names, get_role_by_id($role));
			}
		}

		$deleted_roles     = implode(', ', $deleted_role_names);
		$not_deleted_roles = implode(', ', $not_deleted_role_names);

		$data['type'] = 'success';

		if (empty($deleted_role_ids) && !empty($not_deleted_role_names))
		{
			$output .= (count($not_deleted_role_names) == 1) ? _l('single_role_not_deleted_msg', $not_deleted_roles) : _l('multiple_roles_not_deleted_msg', $not_deleted_roles);

			$data['type'] = 'error';
		}
		else

		if (!empty($deleted_role_ids) && !empty($not_deleted_role_names))
		{
			$output .= (count($deleted_role_ids) == 1) ? _l('single_role_deleted_msg', $deleted_roles) : _l('multiple_roles_deleted_msg', $deleted_roles);

			$output .= (count($not_deleted_role_names) == 1) ? _l('single_role_not_deleted_msg', $not_deleted_roles) : _l('multiple_roles_not_deleted_msg', $not_deleted_roles);
		}
		else
		{
			$output .= (count($deleted_role_ids) == 1) ? _l('single_role_deleted_msg', $deleted_roles) : _l('multiple_roles_deleted_msg', $deleted_roles);
		}

		$data['deleted_role_ids'] = $deleted_role_ids;
		$data['output']           = $output;

		if (!empty($deleted_role_ids))
		{
			$deleted_role_ids = implode(',', $deleted_role_ids);
			log_activity("Roles Deleted [IDs: $deleted_role_ids]");
		}

		echo json_encode($data);
	}

	/**
	 * Contains the Default Permissions to be used in the system.
	 * You can add or remove permissions in this function & it will reflect * on the Roles Module
	 *
	 * @return [array]      The default permissions with features & capabilities
	 */
	public function default_permissions()
	{
		$common_permissions = [
			'view'   => _l('view'),
			'create' => _l('create'),
			'edit'   => _l('edit'),
			'delete' => _l('delete'),
		];

		$permissions = [
			'users'           => [
				'name'         => _l('users'),
				'capabilities' => $common_permissions

			],
			'projects'        => [
				'name'         => _l('projects'),
				'capabilities' => $common_permissions
			],
			'categories'      => [
				'name'         => _l('categories'),
				'capabilities' => $common_permissions
			],
			'roles'           => [
				'name'         => _l('roles'),
				'capabilities' => $common_permissions
			],
			'email_templates' => [
				'name'         => 'Email Templates',
				'capabilities' => [
					'view' => _l('view'),
					'edit' => _l('edit')
				]
			],
			'settings'        => [
				'name'         => _l('settings'),
				'capabilities' => [
					'view'   => _l('view'),
					'create' => _l('create')
				]
			],			
		];

		return $permissions;
	}
}
