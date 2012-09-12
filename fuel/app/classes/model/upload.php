<?php

class Model_Upload extends \Orm\Model {

	public static $_table_name = 'images';

	public static $_properties = array(
		'id',
		'user_id',
		'filename',
		'size',
		'created_at',
	);

	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
			'property' => 'created_at',
		),
	);

	public static function add($id, $image, $size)
	{
		foreach($image as $i)
		{
			$creation = static::forge(array(
				'user_id' 	=> $id,
				'filename'	=> $i['name'].'_test_'.$i['extension'],
				'size'		=> $size
			));
		}

		$creation->save();

		return $creation;
	}
}