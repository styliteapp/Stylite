<?php

class Model_Newuser extends \Orm\Model {

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


	public static function add_user($signupObj)
	{
		$creation = static::forge(array(
			'email' 	=> $signupObj,
			/*'password'	=> $signupObj->password,
			'first_name'=> $signupObj->fName,
			'last_name'	=> $signupObj->lName*/
		));

		$creation->save();

		return $creation;
	}
	
}