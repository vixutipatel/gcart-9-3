<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Loads the settings page
	 */
	public function index()
	{
		if (!has_permissions('settings', 'view'))
		{
			$this->access_denied('settings', 'view');
		}
		else
		{
			$this->set_page_title(_l('settings'));
			$data['settings'] = get_settings();
			$data['content']  = $this->load->view('admin/settings/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/**
	 * Adds or updates setting options
	 */
	public function add()
	{
		$this->set_page_title(_l('settings').' | '._l('add'));

		if (!has_permissions('settings', 'create'))
		{
			$this->access_denied('settings', 'create');
		}
		else

		if ($this->input->post())
		{
			foreach ($this->input->post() as $key => $value)
			{
				$settig_exists = $this->settings->count_by(['name' => $key]);

				if ($settig_exists == 0 && $value != '')
				{
					$data = [
						'name'  => $key,
						'value' => $value
					];

					$this->settings->insert($data);
					log_activity("New Settings Option Created [Name: $key, Value: $value]");
				}

				if ($settig_exists == 1)
				{
					$settings = $this->settings->get_by(['name' => $key]);

					if ($settings['value'] != $value && $value != '')
					{
						$this->settings->update($settings['id'], array('value' => $value));

						log_activity("Settings Option Updated [Name: $key, Value: $value]");
					}
					else

					if ($value == '' || $value == null)
					{
						$delete = $this->settings->delete_by(['name' => $key]);
						log_activity("Settings Option Deleted [Name: $key]");
					}
				}
			}

			echo 'true';
		}
		else
		{
			redirect('admin/settings');
		}
	}

	/**
	 * Sends an smtp test email.
	 */
	public function send_smtp_test_email()
	{
		if ($this->input->post())
		{
			$subject = 'SMTP Setup Testing';
			$message = get_settings('email_header');
			$message .= 'This is test SMTP email. <br />If you have received this message that means your SMTP settings are set correctly.';

			$message .= str_replace('{company_name}', get_settings('company_name'), get_settings('email_footer'));
			$sent = send_email($this->input->post('test_email'), $subject, $message);

			if ($sent)
			{
				echo 'true';
			}
			else
			{
				echo 'false';
			}
		}
	}
}
