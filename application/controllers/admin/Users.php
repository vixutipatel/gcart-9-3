<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model', 'users');
		$this->load->model('role_model', 'roles');
		$this->load->model('user_permission_model', 'user_permissions');
	}

	/**
	 * Loads the list of users.
	 */
	public function index()
	{
		$this->set_page_title(_l('users'));

		if (!has_permissions('users', 'view'))
		{
			$this->access_denied('users', 'view');
		}
		else
		{
			$data['users'] = $this->users->get_all();
			$data['roles'] = $this->roles->get_all();

			$data['content'] = $this->load->view('admin/users/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/**
	 * Add new user
	 */
	public function add()
	{
		$this->set_page_title(_l('users').' | '._l('add'));

		if (!has_permissions('users', 'create'))
		{
			$this->access_denied('users', 'create');
		}
		else

		if ($this->input->post())
		{
			$data = array
				(

				'firstname' => $this->input->post('firstname'),
				'lastname'  => $this->input->post('lastname'),
				'email'     => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no'),
				'password'  => md5($this->input->post('password')),
				'role'      => $this->input->post('role'),
				'is_active' => 1
			);

			if ($this->input->post('role') == 1)
			{
				$data['is_admin'] = 1;
			}
			else
			{
				$data['is_admin'] = 0;
			}

			$insert = $this->users->insert($data);

			$role_id = $this->input->post('role');
			$role    = $this->roles->get($role_id);

			$permissions = unserialize($role['permissions']);

			foreach ($permissions as $key => $permission)
			{
				foreach ($permission as $key_permission => $value)
				{
					$data = array
						('user_id'     => $insert,
						'features'     => $key,
						'capabilities' => $value);

					$permission_insert = $this->user_permissions->insert($data);
				}
			}

			if ($insert)
			{
				set_alert('success', _l('_added_successfully', _l('user')));
				redirect('admin/users');
			}
		}
		else
		{
			$data['roles']   = $this->roles->get_all();
			$data['content'] = $this->load->view('admin/users/create', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/**
	 * Updates the user record
	 *
	 * @param int  $id  The user id
	 */
	public function edit($id = '')
	{
		$this->set_page_title(_l('users').' | '._l('edit'));

		if (!has_permissions('users', 'edit'))
		{
			$this->access_denied('users', 'edit');
		}
		else

		if ($id)
		{
			if ($this->input->post())
			{
				if ($this->input->post('newpassword') == NULL)
				{
					$data = array
						(
						'firstname' => $this->input->post('firstname'),
						'lastname'  => $this->input->post('lastname'),
						'email'     => $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'role'      => $this->input->post('role'),
						'is_active' => ($this->input->post('is_active')) ? 1 : 0
					);
				}
				else
				{
					$data = array
						(
						'firstname' => $this->input->post('firstname'),
						'lastname'  => $this->input->post('lastname'),
						'email'     => $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'password'  => md5($this->input->post('newpassword')),
						'role'      => $this->input->post('role'),
						'is_active' => ($this->input->post('is_active')) ? 1 : 0
					);
				}

				$data['is_admin'] = ($this->input->post('role') == 1) ? 1 : 0;

				$update = $this->users->update($id, $data);

				$this->user_permissions->delete_by(array('user_id' => $id));

				$role_id   = $this->input->post('role');
				$role_data = $this->roles->get_by(array('id' => $role_id));

				$permissions = unserialize($role_data['permissions']);

				foreach ($permissions as $key => $permission)
				{
					if ($permission != NULL)
					{
						foreach ($permission as $key_permission => $value)
						{
							$data = array
								('user_id'     => $id,
								'features'     => $key,
								'capabilities' => $value);

							$permission_insert = $this->user_permissions->insert($data);
						}
					}
				}

				if ($update)
				{
					set_alert('success', _l('_updated_successfully', _l('user')));

					redirect('admin/users');
				}
			}
			else
			{
				$data['user']  = $this->users->get($id);
				$data['roles'] = $this->roles->get_all();

				if (get_loggedin_user_id() == $id)
				{
					redirect('admin/profile/edit');
				}
				else
				{
					$data['content'] = $this->load->view('admin/users/edit', $data, TRUE);
					$this->load->view('admin/layouts/index', $data);
				}
			}
		}
		else
		{
			redirect('admin/users');
		}
	}

	/**
	 * Toggles the user status to Active or Inactive
	 */
	public function update_status()
	{
		$user_id = $this->input->post('user_id');
		$data    = array('is_active' => $this->input->post('is_active'));

		$update = $this->users->update($user_id, $data);

		if ($update)
		{
			if ($this->input->post('is_active') == 1)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
	}

	/**
	 * Deletes the single user record
	 */
	public function delete()
	{
		$user_id = $this->input->post('user_id');
		$deleted = $this->users->delete($user_id);

		if ($deleted)
		{
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}

	/**
	 * Deletes multiple user records
	 */
	public function delete_selected()
	{
		$where   = $this->input->post('ids');
		$deleted = $this->users->delete_many($where);

		if ($deleted)
		{
			$ids = implode(',', $where);
			echo 'true';
		}
		else
		{
			echo 'false';
		}
	}
}
