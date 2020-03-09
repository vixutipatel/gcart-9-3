<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Gets the vendor url.
 *
 * @param  string  $url  The url
 *
 * @return string  The vendor url.
 */
function vendor_url($url = '')
{
	$vendorURI = get_vendor_uri();

	if ($url == '' || $url == '/')
	{
		if ($url == '/')
		{
			$url = '';
		}

		return site_url($vendorURI).'/';
	}

	return site_url($vendorURI.'/'.$url);
}

/**
 * Gets the vendor uri.
 *
 * @return string  The vendor uri.
 */
function get_vendor_uri()
{
	return VENDOR_URI;
}

/**
 * Gets the loggedin vendor identifier.
 *
 * @return int  The loggedin vendor identifier.
 */
function get_loggedin_vendor_id()
{
	return get_instance()->session->userdata('vendor_id');
}

/**
 * Gets the requested info of vendor.
 *
 * @param  int  $id    The id of the vendor.
 * @param  str  $info  The key of the information required.
 *
 * @return mixed The information required.
 */
function get_vendor_info($id, $info = '')
{
	$CI = &get_instance();
	$CI->load->model('vendor_model', 'vendors');

	$vendor = $CI->vendors->get($id);

	if ($info != '')
	{
		return $vendor[$info];
	}
	else
	{
		return $vendor;
	}
}

?>