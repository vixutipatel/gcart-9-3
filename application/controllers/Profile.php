<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'users');
		//$this->load->model('activity_log_model', 'activity_log');
	}

	public function index()
	{
		$this->set_page_title(_l('profile'));
		$id = get_loggedin_user_id();

		if ($id)
		{
			$data['user']  = $this->users->get($id);
			$data['users'] = $this->users->show($id);
		}

		$this->template->load('index', 'content', 'profile/index', $data);
	}

	/**
	 * Updates user's personal profile details
	 * @return [type] [description]
	 */
	public function edit()
	{
		$this->set_page_title(_l('edit_profile'));
		$id = get_loggedin_user_id();

		if ($id)
		{
			$data['user'] = $this->users->get($id);
			$data['user'] = $this->users->show($id);

			$this->template->load('index', 'content', 'profile/edit', $data);
		}

		if ($this->input->post())
		{
			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname'  => $this->input->post('lastname'),
				'email'     => $this->input->post('email'),
				'mobile'    => $this->input->post('mobile')

			);

			$data   = array_map('strip_tags', $data);
			$update = $this->users->update($id, $data);

			$address_1 = $this->input->post('address_1');
			$address_2 = $this->input->post('address_2');
			$city      = $this->input->post('city');
			$state     = $this->input->post('state');
			$pincode   = $this->input->post('pincode');

			$user_address = $this->users->edit($id, $address_1, $address_2, $city, $state, $pincode);

			if ($update == TRUE || $user_address == TRUE)
			{
				set_alert('success', _l('_updated_successfully', _l('profile')));
				log_activity("User Updated Profile [ID:$id]");
				redirect('profile/index');
			}
		}
	}

	/**
	 *Updates user's password
	 * @return [type] [description]
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

			$data   = array_map('strip_tags', $data);
			$update = $this->users->update($id, $data);

			if ($update)
			{
				set_alert('success', _l('_updated_successfully', _l('password')));
				redirect('profile/edit');
			}
		}
	}

/**
 * [uploads file]
 * @return [type] [description]
 */
	public function uploads()
	{
		$id = get_loggedin_user_id();

		$config['upload_path']   = './assets/uploads/users';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 2000;
		$config['max_width']     = 1500;
		$config['max_height']    = 1500;
		$profile_image           = $id.'-'.$_FILES['profile_image']['name'];
		$config['file_name']     = $profile_image;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('profile_image'))
		{
			$error = $this->upload->display_errors();
			error_log($error,0);
			set_alert('warning', _l('_updation_fail_please_try_again', _l('profile')));
			redirect('profile/edit');
		}
		else
		{
			$data = $this->upload->data();
			//var_dump($data);
			$rename = $data['raw_name'].$data['file_ext'];
			//$value = $data['file']['raw_name'].$id.$data['file']['file_ext'];
			$rename = $config['upload_path'].'/'.$rename;

//$result = "UPDATE users  SET profile_image='$value' WHERE id=$id";
			//$query  = $this->db->query($result);
			$data = array(
				'profile_image' => $rename
			);

			$update = $this->users->update($id, $data);

			if ($update)
			{
				set_alert('success', _l('_updated_successfully', _l('profile')));
				redirect('profile/edit');
			}
		}
	}
}
