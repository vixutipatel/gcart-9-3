<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Authentication_model');
	}

	/**
	 * Acts as an entry point
	 */
	public function index()
	{
		$this->login();
	}

	/**
	 * Loads admin login form & performs login
	 */
	public function login()
	{
		if (is_admin_logged_in())
		{
			redirect(admin_url());
		}

		$this->set_page_title(_l('login'));

		if ($this->input->post())
		{
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');

			$user = $this->Authentication_model->login($email, $password, $remember);

			if (is_array($user) && isset($user['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
				log_activity("Inactive User Tried to Login [Email: $email]", $user['id']);
				redirect(admin_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_email']))
			{
				set_alert('error', _l('incorrect_email'));
				log_activity("Non Existing User Tried to Login [Email: $email]");
				redirect(admin_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_password']))
			{
				set_alert('error', _l('incorrect_password'));
				log_activity("Failed Login Attempt With Incorrect Password [Email: $email]", $user['id']);
				redirect(admin_url('authentication'));
			}
			elseif ($user == false)
			{
				set_alert('error', _l('incorrect_email_or_password'));
				log_activity("Failed Login Attempt [Email: $email]");
				redirect(admin_url('authentication'));
			}

			log_activity("User Logged In [Email: $email]");

			//If previous redirect URL is set in session, redirect to that URL
			maybe_redirect_to_previous_url();

			//Else rediret to admin home page.
			redirect(admin_url());
		}

		$data['content'] = $this->load->view('admin/authentication/login_admin', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	 * Loads forgot password form & performs forgot password
	 */
	public function forgot_password()
	{
		$this->set_page_title(_l('forgot_password'));

		if (is_user_logged_in())
		{
			redirect(admin_url());
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->forgot_password($this->input->post('email'), true);

			if (is_array($success) && isset($success['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
			}
			elseif (is_array($success) && isset($success['invalid_user']))
			{
				set_alert('error', _l('incorrect_email'));
			}
			elseif ($success == true)
			{
				set_alert('success', _l('check_email_for_resetting_password'));
			}
			else
			{
				set_alert('error', _l('error_setting_new_password_key'));
			}

			redirect(admin_url('authentication/forgot_password'));
		}

		$data['content'] = $this->load->view('admin/authentication/forgot_password', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	 * Loads reset password form & resets the password
	 *
	 * @param int  $user_id       The user identifier
	 * @param str  $new_pass_key  The new pass key
	 */
	public function reset_password($user_id = 0, $new_pass_key = '')
	{
		if (($user_id == 0) || ($new_pass_key == ''))
		{
			redirect(admin_url());
		}

		$this->set_page_title(_l('reset_password'));

		if (!$this->Authentication_model->can_reset_password($user_id, $new_pass_key))
		{
			set_alert('error', _l('password_reset_key_expired'));
			redirect(admin_url('authentication'));
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->reset_password($user_id, $new_pass_key, $this->input->post('password'));

			if (is_array($success) && $success['expired'] == true)
			{
				set_alert('error', _l('password_reset_key_expired'));
			}
			elseif ($success == true)
			{
				set_alert('success', _l('password_reset_message'));
				log_activity('User Resetted the Password', $user_id);
			}
			else
			{
				set_alert('error', _l('new_password_is_same_as_old_password'));
				redirect(site_url($this->uri->uri_string()));
			}

			redirect(admin_url('authentication'));
		}

		$data['content'] = $this->load->view('admin/authentication/reset_password', '', true);
		$this->load->view('admin/authentication/index', $data);
	}

	/**
	 * Checks if user with provided email id exists or not
	 */
	public function email_exists()
	{
		$exists = $this->users->count_by('email', $this->input->post('email'));

		echo $exists;
	}

	/**
	 * Does logout
	 */
	public function logout()
	{
		log_activity('User Logged Out [Email: '.get_loggedin_info('email').']', get_loggedin_user_id());
		$this->Authentication_model->logout();
		redirect(admin_url('authentication'));
	}

	/**
	 * Does auto logout
	 */
	public function autologout()
	{
		if (get_cookie('autologin', true)) //If user has set REMEMBER ME
		{
			redirect($this->agent->referrer()); //redirect to the same page from where autologin is called.
		}

		$this->logout();
	}
}
