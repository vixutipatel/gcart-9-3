<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('email_model', 'emails');
	}

	/**
	 * Loads the list of templates.
	 */
	public function index()
	{
		$this->set_page_title('Email Templates');

		if (!has_permissions('email_templates', 'view'))
		{
			$this->access_denied('email_templates', 'view');
		}
		else
		{
			$this->load_default_templates();

			$data['templates'] = $this->emails->get_all();
			$data['content']   = $this->load->view('admin/emails/index', $data, TRUE);
			$this->load->view('admin/layouts/index', $data);
		}
	}

	/**
	 * Updates the email template
	 *
	 * @param int  $id  The template id
	 */
	public function email_template($id = '')
	{
		$this->set_page_title('Email Templates | Edit');

		if (!has_permissions('email_templates', 'edit'))
		{
			$this->access_denied('email_templates', 'edit');
		}
		else

		if ($id)
		{
			$data['template'] = $this->emails->get($id);

			if ($this->input->post())
			{
				$data = array
					(
					'subject' => $this->input->post('subject'),
					'message' => $this->input->post('message')
				);

				$update = $this->emails->update($id, $data);

				if ($update)
				{
					set_alert('success', _l('_updated_successfully', 'Email template'));
					log_activity("Email Template Updated [ID:$id]");
					redirect('admin/emails');
				}
			}
			else
			{
				$data['content'] = $this->load->view('admin/emails/email_template', $data, TRUE);
				$this->load->view('admin/layouts/index', $data);
			}
		}
		else
		{
			redirect('admin/emails');
		}
	}

	/**
	 * Loads default templates data into the database if not already exists.
	 */
	private function load_default_templates()
	{
		$templates = $this->default_templates();

		foreach ($templates as $template)
		{
			$template_exists = $this->emails->count_by(['slug' => $template['slug']]);

			if ($template['name'] != '' && $template['slug'] != '')
			{
				if ($template_exists == 0)
				{
					$data = [
						'name'         => $template['name'],
						'slug'         => $template['slug'],
						'placeholders' => serialize($template['placeholders'])
					];

					$this->emails->insert($data);
				}
				else
				{
					$data = [
						'name'         => $template['name'],
						'placeholders' => serialize($template['placeholders'])
					];

					$this->emails->update_by(array('slug' => $template['slug']), $data);
				}
			}
		}
	}

	/**
	 * Contains the Default Email Templates to be used in the system.
	 * You can add or remove Templates in this function & it will reflect  * on the Email Templates Module
	 *
	 * @return [array]      The default email templates with their placeholders information
	 */
	public function default_templates()
	{
		$templates = [
			[
				'name'         => 'Forgot Password',
				'slug'         => 'forgot-password',
				'placeholders' => [
					'{firstname}'          => 'User Firstname',
					'{lastname}'           => 'User Lastname',
					'{email}'              => 'User Email',
					'{reset_password_url}' => 'Reset Password URL',
					'{email_signature}'    => 'Email Signature',
					'{company_name}'       => 'Company Name'
				]
			],
			[
				'name'         => 'New User Sign Up',
				'slug'         => 'new-user-signup',
				'placeholders' => [
					'{firstname}'              => 'User Firstname',
					'{lastname}'               => 'User Lastname',
					'{email_verification_url}' => 'Email Verification URL',
					'{email_signature}'        => 'Email Signature',
					'{company_name}'           => 'Company Name'
				]
			]
		];

		return $templates;
	}
}
