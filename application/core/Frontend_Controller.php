<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Common Controller for all front-end controllers
 */
class Frontend_Controller extends My_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('category_model', 'category');
				$this->load->model('Authentication_model');


		// $this->load->library('template'); //loaded in autoload instead here
		// $this->load->helper('theme'); //loaded in autoload instead here.

		// $this->load->model('setting_model', 'settings');

/* If user is not logged in, redirect to the login page */
		// if (!is_user_logged_in())
		// {
		// 	if (strpos(current_full_url(), '/authentication') === false)
		// 	{
		// 		redirect_after_login_to_current_url();
		// 	}

		// 	redirect(site_url('authentication'));
		// }
	}
}
