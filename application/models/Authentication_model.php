<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Authentication_model extends MY_Model
{
	/**
	 * @var boolean
	 */
	protected $soft_delete = TRUE;

	/**
	 * @var string
	 */
	protected $soft_delete_key = 'is_deleted';

	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_autologin');
		$this->autologin();
	}

	/**
	 * Does login
	 *
	 * @param  str    $email      Email address for login
	 * @param  str    $password   User Password
	 * @param  bool   $remember   Set cookies for user if remember me is checked
	 *
	 * @return bool  True if valid user found, False otherwise
	 */
	public function login($email, $password, $remember)
	{
		if ((!empty($email)) && (!empty($password)))
		{
			$this->db->where('email', $email);
			$user = $this->db->get('users')->row();

			if ($user)
			{
				if ($user->password != md5($password))
				{
					return ['invalid_password' => true, 'id' => $user->id];
				}
			}
			else
			{
				return ['invalid_email' => true];
			}

			if ($user->is_active == 0)
			{
				return ['user_inactive' => true, 'id' => $user->id];
			}

			if ($user->is_admin != 0 && $user->is_email_verified == 0)
			{
				return ['email_unverified' => true, 'id' => $user->id];
			}

			$user_data = [
				'user_id'        => $user->id,
				'email'          => $user->email,
				'username'       => ucwords($user->firstname.' '.$user->lastname),
				'is_admin'       => $user->is_admin,
				'user_logged_in' => true
			];

			$this->session->set_userdata($user_data);

			if ($remember)
			{
				$this->create_autologin($user->id);
			}

			$this->update_login_info($user->id);

			return true;
		}

		return false;
	}

	/**
	 * Does vendor login
	 *
	 * @param  str    $email      Email address for login
	 * @param  str    $password   vendor Password
	 * @param  bool   $remember   Set cookies for vendor if remember me is checked
	 *
	 * @return bool  True if valid vendor found, False otherwise
	 */
	public function vendor_login($email, $password, $remember)
	{
		if ((!empty($email)) && (!empty($password)))
		{
			$this->db->where('email', $email);
			$vendor = $this->db->get('vendors')->row();

			if ($vendor)
			{
				if ($vendor->password != md5($password))
				{
					return ['invalid_password' => true, 'id' => $vendor->id];
				}
			}
			else
			{
				return ['invalid_email' => true];
			}

			if ($vendor->is_active == 0)
			{
				return ['vendor_inactive' => true, 'id' => $vendor->id];
			}

			if ($vendor->is_admin != 1 && $vendor->is_email_verified == 0)
			{
				return ['email_unverified' => true, 'id' => $vendor->id];
			}

			$vendor_data = [
				'vendor_id'        => $vendor->id,
				'email'            => $vendor->email,
				'vendorname'       => ucwords($vendor->firstname.' '.$vendor->lastname),
				'is_admin'         => $vendor->is_admin,
				'vendor_logged_in' => true
			];

			$this->session->set_userdata($vendor_data);

			if ($remember)
			{
				$this->create_autologin($vendor->id);
			}

			$this->update_login_info($vendor->id);

			return true;
		}

		return false;
	}

	/**
	 * Creates an autologin if 'Remember Me' is checked.
	 *
	 * @param  int 	 $user_id  	The user ID to create autologin
	 *
	 * @return bool  True if autologin is set, False otherwise
	 */
	private function create_autologin($user_id)
	{
		$this->load->helper('cookie');
		$key = substr(md5(uniqid(rand())), 0, 16);

		$this->user_autologin->delete($user_id, $key);

		if ($this->user_autologin->set($user_id, md5($key)))
		{
			set_cookie([
				'name'   => 'autologin',
				'value'  => serialize([
					'user_id' => $user_id,
					'key'     => $key
				]),
				'expire' => 60 * 60 * 24 * 7 // 7 days
			]);

			return true;
		}

		return false;
	}

	/**
	 * Deletes an autologin when user logs out
	 */
	private function delete_autologin()
	{
		$this->load->helper('cookie');

		if ($cookie = get_cookie('autologin', true))
		{
			$data = unserialize($cookie);
			$this->user_autologin->delete($data['user_id'], md5($data['key']));
			delete_cookie('autologin', 'aal');
		}
	}

	/**
	 * Does auto login if 'Remember Me' is found to be set active
	 *
	 * @return bool  True if autologin is done, False otherwise
	 */
	public function autologin()
	{
		if (!is_user_logged_in())
		{
			$this->load->helper('cookie');

			if ($cookie = get_cookie('autologin', true))
			{
				$data = unserialize($cookie);

				if (isset($data['key']) && isset($data['user_id']))
				{
					if (!is_null($user = $this->user_autologin->get($data['user_id'], md5($data['key']))))
					{
						$user_data = [
							'user_id'        => $user->id,
							'email'          => $user->email,
							'username'       => ucwords($user->firstname.' '.$user->lastname),
							'is_admin'       => $user->is_admin,
							'user_logged_in' => true
						];

						$this->session->set_userdata($user_data);
						$this->update_login_info($user->id);

						return true;
					}
				}
			}
		}

		return false;
	}

	/**
	 * Update login info on autologin
	 *
	 * @param int  $user_id  The user identifier
	 */
	private function update_login_info($user_id)
	{
		$this->db->set('last_ip', $this->input->ip_address());
		$this->db->set('last_login', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);
		$this->db->update('users');
	}

	/**
	 *
	 * Generates new password key for the user to reset the password
	 *
	 * @param  str   $email  The email from the user
	 *
	 * @return bool  True if user exists & link is sent to user email, False otherwise
	 */
	public function forgot_password($email)
	{
		$this->db->where('email', $email);
		$user = $this->db->get('users')->row();

		if ($user)
		{
			if ($user->is_active == 0)
			{
				return ['user_inactive' => true];
			}

			if ($user->is_admin != 0 && $user->is_email_verified == 0)
			{
				return ['email_unverified' => true];
			}

			$new_pass_key = app_generate_hash();
			$this->db->where('id', $user->id);
			$this->db->update('users', [
				'new_pass_key'           => $new_pass_key,
				'new_pass_key_requested' => date('Y-m-d H:i:s')
			]);

			if ($this->db->affected_rows() > 0)
			{
				$template = get_email_template('forgot-password');
				$subject  = $template['subject'];

				$message = get_settings('email_header');

				$this->db->where('email', $email);
				$user = $this->db->get('users')->row_array();

				if ($user->is_admin == 1)
				{
					$reset_password_link = admin_url('authentication/reset_password/').$user['id'].'/'.$user['new_pass_key'];
				}
				else
				{
					$reset_password_link = site_url('authentication/reset_password/').$user['id'].'/'.$user['new_pass_key'];
				}

				$find = [
					'{firstname}',
					'{lastname}',
					'{email}',
					'{reset_password_link}',
					'{email_signature}',
					'{company_name}'
				];

				$replace = [
					$user['firstname'],
					$user['lastname'],
					$email,
					$reset_password_link,
					get_settings('email_signature'),
					get_settings('company_name')
				];

				$message .= str_replace($find, $replace, $template['message']);

				$message .= str_replace('{company_name}', get_settings('company_name'), get_settings('email_footer'));

				$sent = send_email($email, $subject, $message);

				if ($sent)
				{
					return true;
				}

				return false;
			}

			return false;
		}

		return ['invalid_user' => true];
	}

	public function verify_email($sign_up_key)
	{
		$this->db->where('sign_up_key', $sign_up_key);

		if ($this->db->get('users')->num_rows() == 1)
		{
			$this->db->set('is_email_verified', 1);
			$this->db->set('is_active', 1);
			$this->db->where('sign_up_key', $sign_up_key);
			$this->db->update('users');

			return true;
		}

		return null;
	}

	/**
	 * Resets user password after successful validation of the key
	 *
	 * @param  int   $user_id       The user identifier
	 * @param  str   $new_pass_key  The new pass key
	 * @param  str   $password      The password
	 *
	 * @return bool  True if the password is reset, Null otherwise
	 */
	public function reset_password($user_id, $new_pass_key, $password)
	{
		if (!$this->can_reset_password($user_id, $new_pass_key))
		{
			return ['expired' => true];
		}

		$this->db->where('id', $user_id);
		$this->db->where('new_pass_key', $new_pass_key);
		$this->db->update('users', ['password' => md5($password)]);

		if ($this->db->affected_rows() > 0)
		{
			$this->db->set('new_pass_key', null);
			$this->db->set('new_pass_key_requested', null);
			$this->db->set('last_password_change', date('Y-m-d H:i:s'));
			$this->db->where('id', $user_id);
			$this->db->where('new_pass_key', $new_pass_key);
			$this->db->update('users');

			return true;
		}

		return null;
	}

	/**
	 * Determines if the key is not expired or doesn't exists in database
	 *
	 * @param  int  $user_id       The user identifier
	 * @param  str  $new_pass_key  The new pass key
	 *
	 * @return bool True if key is active, False otherwise
	 */
	public function can_reset_password($user_id, $new_pass_key)
	{
		$this->db->where('id', $user_id);
		$this->db->where('new_pass_key', $new_pass_key);
		$user = $this->db->get('users')->row();

		if ($user)
		{
			$timestamp_now_minus_1_hour = time() - (60 * 60);
			$new_pass_key_requested     = strtotime($user->new_pass_key_requested);

			if ($timestamp_now_minus_1_hour > $new_pass_key_requested)
			{
				return false;
			}

			return true;
		}

		return false;
	}

	/**
	 * Clears the autologin & session
	 */
	public function logout()
	{
		$this->delete_autologin();

		$this->session->sess_destroy();
	}
}
