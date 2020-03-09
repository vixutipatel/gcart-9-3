<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('user_model', 'users');
		$this->load->model('activity_log_model', 'activity_log');
	}

	/**
	 * Updates user's personal profile details
	 */
	public function edit()
	{
		$this->set_page_title(_l('edit_profile'));
		$id = get_loggedin_user_id();

		if ($id)
		{
			$data['user']    = $this->users->get($id);
			$data['content'] = $this->load->view('admin/profile/edit', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}

		if ($this->input->post())
		{
			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname'  => $this->input->post('lastname'),
				'email'     => $this->input->post('email'),
				'mobile_no' => $this->input->post('mobile_no')
			);

			$update = $this->users->update($id, $data);

			if ($update)
			{
				set_alert('success', _l('_updated_successfully', _l('profile')));
				log_activity("User Updated Profile [ID:$id]");
				redirect('admin/profile/edit');
			}
		}
	}

	/**
	 * Updates user's password
	 */
	public function edit_password()
	{
		$id           = get_loggedin_user_id();
		$data['user'] = $this->users->get($id);

		if ($this->input->post())
		{
			$data = array
				(
				'password'             => md5($this->input->post('new_password')),
				'last_password_change' => date('Y-m-d H:i:s')
			);

			$update = $this->users->update($id, $data);

			if ($update)
			{
				set_alert('success', _l('_updated_successfully', _l('password')));
				redirect('admin/profile/edit');
			}
		}
	}
}
