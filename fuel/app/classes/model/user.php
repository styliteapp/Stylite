<?php

class Model_User extends \Orm\Model {

	public static $_table_name = 'users';

	public static $_properties = array(
		'id',
		'email',
		'password',
		'first_name',
		'last_name',
		'created_at',
	);

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
			'property' => 'created_at',
		),
	);

	public static function add_user($email, $password, $fName, $lName)
	{
		$creation = static::forge(array(
			'email' 	=> $email,
			'password'	=> sha1($password.'$ty|eN3veRfAd3S'),
			'first_name'=> $fName,
			'last_name'	=> $lName
		));

		$creation->save();

		return $creation;
	}

	public static function log_in($email, $password)
	{
		$hash_pass = sha1($password.'$ty|eN3veRfAd3S');

		$query = static::find()->where('password', $hash_pass)->get_one();

		return $query;
	}
}