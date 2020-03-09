<?php defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');

/**
 * Get the date & time as per the format set in the settings
 *
 * @param  int  $timestamp  The timestamp
 *
 * @return str  formatted date and/or time
 */
function display_date_time($datetime)
{
	$timestamp = strtotime($datetime);

	if (get_settings('date_format') != '' && get_settings('time_format') != '')
	{
		return date(get_settings('date_format').'  '.get_settings('time_format'), $timestamp);
	}
	else

	if (get_settings('date_format') != '' && get_settings('time_format') == '')
	{
		return date(get_settings('date_format').'  h:i A', $timestamp);
	}
	else

	if (get_settings('date_format') == '' && get_settings('time_format') != '')
	{
		return date('d-m-Y  '.get_settings('time_format'), $timestamp);
	}
	else
	{
		return date('d-m-Y  h:i A', $timestamp);
	}
}

/**
 * Converts timestamp into words
 *
 * @param int  $timestamp  The timestamp
 */
function time_to_words($datetime)
{
	$timestamp = strtotime($datetime);
	$time_difference = time() - $timestamp;

	$seconds = $time_difference;
	$minutes = round($time_difference / 60);
	$hours   = round($time_difference / 3600);
	$days    = round($time_difference / 86400);
	$weeks   = round($time_difference / 604800);
	$months  = round($time_difference / 2419200);
	$years   = round($time_difference / 29030400);

	if ($seconds <= 60)
	{
		$time_in_words = $minutes.' '._l('seconds');
	}
	elseif ($minutes <= 60)
	{
		$time_in_words = ($minutes == 1) ? $minutes.' '._l('minute') : $minutes.' '._l('minutes');
	}
	elseif ($hours <= 24)
	{
		$time_in_words = ($hours == 1) ? $hours.' '._l('hour') : $hours.' '._l('hours');
	}
	elseif ($days <= 7)
	{
		$time_in_words = ($days == 1) ? $days.' '._l('day') : $days.' '._l('days');
	}
	elseif ($weeks <= 4)
	{
		$time_in_words = ($weeks == 1) ? $weeks.' '._l('week') : $weeks.' '._l('weeks');
	}
	elseif ($months <= 12)
	{
		$time_in_words = ($months == 1) ? $months.' '._l('month') : $months.' '._l('months');
	}
	elseif ($years)
	{
		$time_in_words = ($years == 1) ? $years.' '._l('year') : $years.' '._l('years');
	}

	return $time_in_words;
}

?>