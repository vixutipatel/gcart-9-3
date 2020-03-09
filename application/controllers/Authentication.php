<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Authentication_model');
		$this->load->model('User_model', 'users');
	}

	public function index()
	{
		$this->login();
	}
/**
 * [login user]
 * @return [type] [description]
 */
	public function login()
	{
		if (is_user_logged_in())
		{
			redirect(site_url());
		}

		if ($this->input->post())
		{
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = $this->input->post('remember');
			$user     = $this->Authentication_model->login($email, $password, $remember);

			if (is_array($user) && isset($user['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
				log_activity("Inactive User Tried to Login [Email: $email]", $user['id']);
				redirect(site_url('authentication'));
			}
			elseif (is_array($user) && isset($user['email_unverified']))
			{
				set_alert('error', 'Your email is not verified. Please verify your email first.');
				log_activity("Non Verified User Tried to Login [Email: $email]");
				redirect(site_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_email']))
			{
				set_alert('error', _l('incorrect_email'));
				log_activity("Non Existing User Tried to Login [Email: $email]");
				redirect(site_url('authentication'));
			}
			elseif (is_array($user) && isset($user['invalid_password']))
			{
				set_alert('error', _l('incorrect_password'));
				log_activity("Failed Login Attempt With Incorrect Password [Email: $email]", $user['id']);
				redirect(site_url('authentication'));
			}
			elseif ($user == false)
			{
				set_alert('error', _l('incorrect_email_or_password'));
				log_activity("Failed Login Attempt [Email: $email]");
				redirect(site_url('authentication'));
			}

			log_activity("User Logged In [Email: $email]");

			//If previous redirect URL is set in session, redirect to that URL
			maybe_redirect_to_previous_url();

			//Else rediret to home page.
			redirect(site_url());
		}

		$this->set_page_title('Login');
		$this->template->load('index', 'content', 'authentication/login_signup');
	}
/**
 * [signup users]
 * @return [type] [description]
 */
	public function signup()
	{
		if ($this->input->post())
		{
			$data = $this->input->post();

			$data['password'] = md5($data['password']);
			unset($data['confirm_password']);

			$data['sign_up_key'] = app_generate_hash();

			if ($this->users->insert($data))
			{
				$template = get_email_template('new-user-signup');
				$subject  = str_replace('{company_name}', get_settings('company_name'), $template['subject']);

				$message = get_settings('email_header');

				$find = [
					'{firstname}',
					'{lastname}',
					'{email_verification_url}',
					'{email_signature}',
					'{company_name}'
				];

				$replace = [
					$data['firstname'],
					$data['lastname'],
					site_url('authentication/verify_email/').$data['sign_up_key'],
					get_settings('email_signature'),
					get_settings('company_name')
				];

				$message .= str_replace($find, $replace, $template['message']);

				$message .= str_replace('{company_name}', get_settings('company_name'), get_settings('email_footer'));

				$sent = send_email($data['email'], $subject, $message);

				if ($sent)
				{
					set_alert('success', 'Your are registered successfully. Please check your email for account verification instructions.');
					redirect(site_url('authentication'));
				}
			}
		}

		$this->set_page_title('Sign Up');
		$this->template->load('index', 'content', 'authentication/login_signup');
	}
/**
 * [verify_email description]
 * @param  string $sign_up_key [description]
 * @return [type]              [description]
 */
	public function verify_email($sign_up_key = '')
	{
		if ($sign_up_key == '')
		{
			redirect(site_url());
		}

		$success = $this->Authentication_model->verify_email($sign_up_key);

		if ($success == true)
		{
			set_alert('success', 'Your Email is verified. You can login now.');
		}
		else
		{
			set_alert('error', 'Some issue in verifying your email.');
		}

		redirect(site_url('authentication'));
	}

	/**
	 * Loads forgot password form & performs forgot password
	 * @return [type] [description]
	 */
	public function forgot_password()
	{
		$this->set_page_title(_l('forgot_password'));

		if (is_user_logged_in())
		{
			redirect(site_url());
		}

		if ($this->input->post())
		{
			$success = $this->Authentication_model->forgot_password($this->input->post('email'), true);

			if (is_array($success) && isset($success['user_inactive']))
			{
				set_alert('error', _l('your_account_is_not_active'));
			}
			elseif (is_array($success) && isset($success['email_unverified']))
			{
				set_alert('error', 'Your email is not verified. Please verify your email first.');
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

			redirect(site_url('authentication/forgot_password'));
		}

		$this->template->load('index', 'content', 'authentication/forgot_password');
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
			redirect(site_url());
		}

		$this->set_page_title(_l('reset_password'));

		if (!$this->Authentication_model->can_reset_password($user_id, $new_pass_key))
		{
			set_alert('error', _l('password_reset_key_expired'));
			redirect(site_url('authentication'));
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

			redirect(site_url('authentication'));
		}

		$this->template->load('index', 'content', 'authentication/reset_password');
	}

	/**
	 * Checks if user with provided email id exists or not
	 * @return [type] [description]
	 */
	public function email_exists()
	{
		$exists = $this->users->count_by('email', $this->input->post('email'));

		echo $exists;
	}

	/**
	 * logout [Does logout]
	 * @return [type] [description]
	 */
	public function logout()
	{
		log_activity('User Logged Out [Email: '.get_loggedin_info('email').']', get_loggedin_user_id());
		$this->Authentication_model->logout();
		redirect(site_url());
	}
}
