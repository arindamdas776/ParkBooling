<?php

namespace App\Lib;

use App\Models\LogsEmail;
use Mail;

class Email
{
	public static function send($to, $from = 'noreply@eeaa.com', $subject, $template, $data)
	{
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= "From: ".$from;
		$info = json_decode(json_encode([
			'from' => $from,
			'subject' => $subject,
			'to' => $to,
		]));
		Mail::send($template, $data, function ($message) use ($info) {
			$message->from($info->from);
			$message->subject($info->subject);
			$message->to($info->to);
		});
		if(count(Mail::failures()) > 0) {
			return json_encode(Mail::failures());
		} else {
            $logsemail = new LogsEmail;
            $logsemail->from  = $from;
            $logsemail->to  = $to;
            $logsemail->subject  = $subject;
            $logsemail->body  = json_encode($data);
            $logsemail->created_at  = date('Y-m-d H:i:s');
            $logsemail->response  = true;
            $logsemail->save();
			return true;
		}
	}
}


?>
