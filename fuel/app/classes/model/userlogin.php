<?php

class Model_Userlogin extends \Orm\Model {

	public static $_table_name = 'users';

	public static $_properties = array(
		'id',
		'email',
		'first_name',
		'last_name'
	);

	public static function log_in($email, $password)
	{
		$hash_pass = sha1($password.'$ty|eN3veRfAd3S');

		$query = static::find()->where('password', $hash_pass)->get_one();

		$user = (Object) array(
			'id'		=>	$query->id
			'email'		=>	$query->email,
			'first_name'=>	$query->first_name,
			'last_name'	=>	$query->last_name,
		);

		return $user;
	}
	
}