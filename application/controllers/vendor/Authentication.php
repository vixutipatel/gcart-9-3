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
		$this->vendor_login();
	}

	/**
	 * Loads vendor login form & performs login
	 */
	public function vendor_login()
	{
		if (is_vendor_logged_in())
		{
			redirect(vendor_url());
		}

		$this->set_page_title(_l('login'));

		if ($this->input->post())
		{
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');

			$vendor = $this->Authentication_model->vendor_login($email, $password, $remember);

			if (is_array($vendor) && isset($vendor['vendor_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
				log_activity("Inactive vendor Tried to Login [Email: $email]", $vendor['id']);
				redirect(vendor_url('authentication'));
			}
			elseif (is_array($vendor) && isset($vendor['invalid_email']))
			{
				set_alert('error', _l('incorrect_email'));
				log_activity("Non Existing vendor Tried to Login [Email: $email]");
				redirect(vendor_url('authentication'));
			}
			elseif (is_array($vendor) && isset($vendor['invalid_password']))
			{
				set_alert('error', _l('incorrect_password'));
				log_activity("Failed Login Attempt With Incorrect Password [Email: $email]", $vendor['id']);
				redirect(vendor_url('authentication'));
			}
			elseif ($vendor == false)
			{
				set_alert('error', _l('incorrect_email_or_password'));
				log_activity("Failed Login Attempt [Email: $email]");
				redirect(vendor_url('authentication'));
			}

			log_activity("vendor Logged In [Email: $email]");

			//If previous redirect URL is set in session, redirect to that URL
			maybe_redirect_to_previous_url();

			//Else rediret to vendor home page.
			redirect(vendor_url());
		}

		$data['content'] = $this->load->view('vendor/authentication/login_vendor', '', true);
		$this->load->view('vendor/authentication/index', $data);
	}

	/**
	 * Loads forgot password form & performs forgot password
	 */
	public function forgot_password()
	{
		$this->set_page_title(_l('forgot_password'));

		if (is_vendor_logged_in())
		{
			redirect(vendor_url());
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->forgot_password($this->input->post('email'), true);

			if (is_array($success) && isset($success['vendor_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
			}
			elseif (is_array($success) && isset($success['invalid_vendor']))
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

			redirect(vendor_url('authentication/forgot_password'));
		}

		$data['content'] = $this->load->view('vendor/authentication/forgot_password', '', true);
		$this->load->view('vendor/authentication/index', $data);
	}

	/**
	 * Loads reset password form & resets the password
	 *
	 * @param int  $vendor_id       The vendor identifier
	 * @param str  $new_pass_key  The new pass key
	 */
	public function reset_password($vendor_id = 0, $new_pass_key = '')
	{
		if (($vendor_id == 0) || ($new_pass_key == ''))
		{
			redirect(vendor_url());
		}

		$this->set_page_title(_l('reset_password'));

		if (!$this->Authentication_model->can_reset_password($vendor_id, $new_pass_key))
		{
			set_alert('error', _l('password_reset_key_expired'));
			redirect(vendor_url('authentication'));
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->reset_password($vendor_id, $new_pass_key, $this->input->post('password'));

			if (is_array($success) && $success['expired'] == true)
			{
				set_alert('error', _l('password_reset_key_expired'));
			}
			elseif ($success == true)
			{
				set_alert('success', _l('password_reset_message'));
				log_activity('vendor Resetted the Password', $vendor_id);
			}
			else
			{
				set_alert('error', _l('new_password_is_same_as_old_password'));
				redirect(site_url($this->uri->uri_string()));
			}

			redirect(vendor_url('authentication'));
		}

		$data['content'] = $this->load->view('vendor/authentication/reset_password', '', true);
		$this->load->view('vendor/authentication/index', $data);
	}

	/**
	 * Checks if vendor with provided email id exists or not
	 */
	public function email_exists()
	{
		$exists = $this->vendors->count_by('email', $this->input->post('email'));
		echo $exists;
	}

	/**
	 * Does logout
	 */
	public function logout()
	{
		log_activity('vendor Logged Out [Email: '.get_loggedin_info('email').']', get_loggedin_vendor_id());
		$this->Authentication_model->logout();
		redirect(vendor_url('authentication'));
	}

	/**
	 * Does auto logout
	 */
	public function autologout()
	{
		if (get_cookie('autologin', true)) //If vendor has set REMEMBER ME
		{
			redirect($this->agent->referrer()); //redirect to the same page from where autologin is called.
		}

		$this->logout();
	}
}
