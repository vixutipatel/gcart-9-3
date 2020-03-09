<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
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
	}

/**
 * [show description]
 * @param  [int] $id [user id]
 * @return [query]     [array]
 */
	public function show($id)
	{
		//$sql = 'SELECT * FROM users_address ';
		$sql   = "SELECT users.*,users_address.address_1, users_address.address_2,users_address.city,users_address.state,users_address.pincode,users_address.state FROM users INNER JOIN users_address ON users.id = users_address.users_id WHERE users.id=$id  ";
		$query = $this->db->query($sql);
		//print_r($query);

		return $query->result_array();
	}

/**
 * [edit user address ]
 * @param  [array] $data [user details]
 * @param  [int] $id   [user id]
 * @return [array]   $query    [user-address data]
 */
	public function edit($id, $address_1, $address_2, $city, $state, $pincode)
	{
		$result = "UPDATE users_address as a SET a.address_1='$address_1',a.address_2='$address_2',a.city='$city',a.state='$state',a.pincode='$pincode' WHERE a.users_id=$id";
		$query  = $this->db->query($result);

		return $query;
	}

}
