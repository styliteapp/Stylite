<?php

class Model_Upload extends \Orm\Model {

	public static $_table_name = 'images';

	public static $_properties = array(
		'id',
		'user_id',
		'filename',
		'created_at',
	);

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
			'property' => 'created_at',
		),
	);

	//working
	public static function add($id, $filename)
	{
		
	}
}