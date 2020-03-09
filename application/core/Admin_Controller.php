<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Common Controller for all admin controllers
 */
class Admin_Controller extends My_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('setting_model', 'settings');

/* If user is not logged in, redirect to the admin login page */
		if (!is_admin_logged_in())
		{
			if (strpos(current_full_url(), get_admin_uri().'/authentication') === false)
			{
				redirect_after_login_to_current_url();
			}

			if (is_user_logged_in())
			{
				redirect(site_url('authentication'));
			}

			if (is_vendor_logged_in())
			{
				redirect(site_url('authentication'));
			}

			redirect(admin_url('authentication'));
		}
	}

	/**
	 * Loads the access denied page if the user does not have enough permission to access any page.
	 *
	 * @param  str  $feature     The feature/module
	 * @param  str  $capability  The capability/action
	 */
	function access_denied($feature, $capability)
	{
		$this->session->set_userdata('redirect_url', current_url());

		$data['content'] = $this->load->view('admin/includes/access_denied', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

		log_activity("User tried to access the page without permission [$feature, $capability]");
	}
}
