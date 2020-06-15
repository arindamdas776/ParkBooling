<?php

namespace App\Lib;

use Mail;

class Email
{
	public static function sendMail($to, $subject, $txt, $from = 'noreply@eeaa.com')
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from;
		$data = [
			'txt' => $txt
		];
		$info = json_decode(json_encode([
			'from' => $from,
			'subject' => $subject,
			'to' => $to,
		]));
		Mail::send('emails.regverify', $data, function ($message) use ($info) {
			$message->from($info->from);
			$message->subject($info->subject);
			$message->to($info->to);
		});
		if(count(Mail::failures()) > 0) {
			return json_encode(Mail::failures());
		} else {
			return true;
		}
	}
}


?>
