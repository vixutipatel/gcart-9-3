<?php defined('BASEPATH') or exit('No direct script access allowed');
 
/**
 * Gets the current theme.
 *
 * @return string  The current theme.
 */
function get_current_theme()
{
	$CI = &get_instance();

	if (null != $CI->config->item('default_theme'))
	{
		return $CI->config->item('default_theme');
	}
	else
	{
		return 'default';
	}
}

/**
 * Gets the current theme directoy path.
 *
 * @return string  The current theme directoy path.
 */
function get_current_theme_directoy_path()
{
	return 'themes/'.get_current_theme().'/';
}

?>