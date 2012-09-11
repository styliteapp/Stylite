<?php

class Model_Userlogin extends \Orm\Model {

	public static $_table_name = 'users';

	public static $_properties = array(
		'email',
		'password',
	);

	public static function log_in($email, $password)
	{
		$hash_pass = sha1($password.'$ty|eN3veRfAd3S');

		$loggedin = static::find()->where('password', $hash_pass)->get_one();

		foreach($loggedin->result() as $detail)
		{
			$user[] = $detail;
		}

		return $user;
	}
	
}