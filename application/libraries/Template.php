<?php
/**
 * Class for template.
 */
class Template
{
	//ci instance
	private $CI;

	//template Data
	var $template_data = array();

	/**
	 * Constructor for the class
	 */
	public function __construct()
	{
		$this->CI = &get_instance();
	}

	/**
	 * Sets the template based on the content area and value
	 *
	 * @param str  $content_area  The content area
	 * @param str  $value         The value
	 */
	function set($content_area, $value)
	{
		$this->template_data[$content_area] = $value;
	}

	/**
	 * Loads the template with the passed parameters
	 *
	 * @param str  $template   The template
	 * @param str  $name       The name
	 * @param str  $view       The view
	 * @param arr  $view_data  The view data
	 * @param bol  $return     The return
	 */
	function load($template = '', $name = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->set($name, $this->CI->load->view(get_current_theme_directoy_path().$view, $view_data, TRUE));
		$this->CI->load->view(get_current_theme_directoy_path().'layouts/'.$template, $this->template_data);
	}

}
?>
