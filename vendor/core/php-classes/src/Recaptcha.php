<?php

namespace Core;

class Recaptcha
{

	public static function execute($campo)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
		'secret'=>'sua_chave_privada',
		'response'=>$campo,
		'remoteip'=>$_SERVER['REMOTE_ADDR']
		)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$recaptcha = json_decode(curl_exec($ch), true);
		curl_close($ch);

		return $recaptcha['success'];
	}
}
