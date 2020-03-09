<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category_model extends MY_Model
{
	/**
	 * @var mixed
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
		//$CI = &get_instance();
	}

	/**
	 * [get_parent_category description]
	 * @return [boolean] Query true return sub catgories or return false
	 */
	public function get_parent_category($is_header = '')
	{
		if (empty($is_header))
		{
			$query = $this->db->get_where('categories', array('is_active' => 1));

			if ($query)
			{
				return $query->result();
			}

			return false;
		}
		else
		{
			$query = $this->db->get_where('categories', array('is_active' => 1, 'is_header' => $is_header));

			if ($query)
			{
				return $query->result();
			}

			return false;
		}
	}

/**
 * [get_sub_category description]
 * @return [boolean] Query true return sub catgories or return false
 */
	public function get_sub_category($id = '')
	{
		if ($id)
		{
			$this->db->where(array('category_id' => $id));
			$query = $this->db->get('sub_categories');

			if ($query == TRUE)
			{
				return $query->result();
			}

			return false;
		}
		else
		{
			$query = $this->db->get('sub_categories');

			if ($query == TRUE)
			{
				return $query->result();
			}

			return false;
		}
	}

	/**
	 * [get_parent_category_products description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function get_parent_category_products($id)
	{
		$query = $this->db->get_where('products', array('category_id' => $id));

		if ($query == TRUE)
		{
		return $query->result_array();
		}

		return false;
	}

	/**
	 * [get_sub_category_products description]
	 * @param  [int] $id  Sub categories Primary Key
	 *
	 * @return [boolean]    Query true return sub catgory wise products or return false
	 */
	public function get_sub_category_products($id)
	{
		$query = $this->db->get_where('products', array('sub_category_id' => $id));

		if ($query == TRUE)
		{
		return $query->result_array();
		}

		return false;
	}

	/**
	 * [search category or product or brand]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public function search($category_id, $name = '')
	{
		$this->db->select('c.name as category,p.name as product ,p.tags ,s.name as subcategory,c.id as c_id,p.id as p_id,s.id as s_id', TRUE);
		$this->db->from('categories as c');
		$this->db->join('sub_categories as s', ' s.category_id=c.id');
		$this->db->join('products as p', ' c.id=p.category_id');
		$this->db->join('brands as b', ' p.brand_id=b.id ');

		if ($category_id == '*' && empty($name))
		{
			$this->db->where(array('c.is_header' => 1));
		}
		elseif (!empty($name))
		{
			if ($category_id == '*')
			{
				$this->db->where(array('c.is_header' => 1));
			}
			elseif ($name)
			{
				$this->db->where(array('c.is_header' => 1));
			}
			else
			{
				$this->db->where(array('c.is_header' => 1, 'c.id' => $category_id));
			}

			$this->db->like('s.name', $name, 'match');
			$this->db->or_like('p.name', $name, 'match');
			$this->db->or_like('p.tags', $name, 'match');
		}
		else
		{
			$this->db->where(array('c.is_header' => 1, 'c.id' => $category_id));
		}

		$query = $this->db->get();

		return $query->result_array();
	}
}
