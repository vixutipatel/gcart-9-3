<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Common Controller for entire application
 */
class MY_Controller extends CI_Controller
{
	/**
	 * Page Title to be set for each page which will be shown in Browser Tab using <title> tag
	 */
	public $page_title;

	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('english');
		$this->load->model('category_model', 'category');
	}

	/**
	 * Set the page title.
	 * @param str $page_title The title to be set.
	 *
	 * @return str  The page title.
	 */
	public function set_page_title($page_title)
	{
		if (strpos(current_full_url(), '/admin') == true)
		{
			$this->page_title = get_settings('company_name').' | Admin Panel | '.$page_title;
		}
		elseif (strpos(current_full_url(), '/vendor') == true)
		{
			$this->page_title = get_settings('company_name').' | Vendor Panel | '.$page_title;
		}
		else
		{
			$this->page_title = get_settings('company_name').' | '.$page_title;
		}
	}
}
