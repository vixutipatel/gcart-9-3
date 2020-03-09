<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Sends an email.
 *
 * @param  str  $email    The email
 * @param  str  $subject  The subject
 * @param  str  $message  The message
 *
 * @return bool True if mail is sent. False otherwise.
 */
function send_email($email, $subject, $message)
{
	$CI = &get_instance();
	$CI->load->config('email');
	$CI->load->library('email');

	$CI->email->from(get_settings('smtp_user'), get_settings('from_name'));
	$CI->email->reply_to(get_settings('reply_to_email'), get_settings('reply_to_name'));
	$CI->email->to($email);

	/* if BCC email is set in settings, send mail to BCC email */
	if (get_settings('bcc_emails_to') != '')
	{
		$CI->email->bcc(get_settings('bcc_emails_to'));
	}

	$CI->email->subject($subject);
	$CI->email->message($message);

	if ($CI->email->send())
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>