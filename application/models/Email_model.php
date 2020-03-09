<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends MY_Model
{
		
	/**
	 * @var string
	 */
	protected $_table = 'email_templates';
	
	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		parent::__construct();

	}
}
