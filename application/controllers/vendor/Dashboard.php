<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Vendor_Controller
{
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Loads the vendor dashboard
	 */
	public function index()
	{
		$this->set_page_title(_l('dashboard'));

		$data['content'] = $this->load->view('vendor/dashboard/index', '', TRUE);
		$this->load->view('vendor/layouts/index', $data);

	}
}
