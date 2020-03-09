<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();

		$this->load->model('Product_model', 'product');
	}

	public function index()
	{
		$this->get_main_categories();
	}

	/**
	 * [search_category ]
	 * @return [type] [description]
	 */
	public function search()
	{
		if ($this->input->post('category_id'))
		{
			$name        = $this->input->post('name');
			$category_id = $this->input->post('category_id');
			$data        = $this->category->search($category_id, $name);

var_dump($data);
die;
			foreach ($data as $search)
			{
//echo $search['p_id']."<br>";

//echo $search['s_id']."<br>"
				if (!empty($search['s_id']))
				{
					$data['sub_category_products'] = $this->category->get_sub_category_products($search['s_id']);
					print_r($data['sub_category_products']);
				}
				else
				{
					$data['parent_category_products'] = $this->category->get_parent_category_products($search['c_id']);
					print_r($data['parent_category_products']);

					//print_r($data['parent_category_products']);
				}

				$this->template->load('index', 'content', 'products/index', $data);
			}

//var_dump($data[0]['name']);
			if (!$data)
			{
				set_alert('error', _l('no_data_found', _l('')));
				redirect();
			}
			else
			{
				//redirect('authentication');
			}
		}
	}

	public function get_parent_category_products()
	{
		$parent_id = $this->uri->segment(3);
		$this->category->get_parent_category_products($parent_id);

// $this->data=$this->get_all();
		// $this->template->load('index', 'content', 'products/index', $this->data);

		return true;
	}

	public function get_sub_category_products()
	{
		$parent_id                     = $this->uri->segment(3);
		$data['sub_category_products'] = $this->category->get_sub_category_products($parent_id);

//$this->data=$this->get_all();
		//$this->template->load('index', 'content', 'products/index', $data);
	}
}
