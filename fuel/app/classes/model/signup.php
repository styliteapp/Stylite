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
	
}