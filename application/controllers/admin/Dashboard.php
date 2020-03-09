<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Loads the admin dashboard
	 */
	public function index()
	{
		$this->set_page_title(_l('dashboard'));

		$data['content'] = $this->load->view('admin/dashboard/index', '', TRUE);
		$this->load->view('admin/layouts/index', $data);

	}
}
