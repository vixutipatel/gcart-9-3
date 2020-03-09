<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Gets the admin url.
 *
 * @param  string  $url  The url
 *
 * @return string  The admin url.
 */
function admin_url($url = '')
{
	$adminURI = get_admin_uri();

	if ($url == '' || $url == '/')
	{
		if ($url == '/')
		{
			$url = '';
		}

		return site_url($adminURI).'/';
	}

	return site_url($adminURI.'/'.$url);
}

/**
 * Gets the admin uri.
 *
 * @return string  The admin uri.
 */
function get_admin_uri()
{
	return ADMIN_URI;
}
