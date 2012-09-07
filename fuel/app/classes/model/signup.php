<?php

class Model_Signup extends \Orm\Model {

	public static $_table_name = 'NewsletterEmails';

	public static $_properties = array(
		'id',
		'email',
		'created_at',
	);

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
			'property' => 'created_at',
		),
	);


	public static function add_email($email)
	{
		$valid = filter_var($email, FILTER_VALIDATE_EMAIL);

		if ($valid === false)
		{
			return false;
		}

		$subscription = static::forge(array(
			'email' => $email,
		));

		$subscription->save();

		return $subscription;
	}
	
}