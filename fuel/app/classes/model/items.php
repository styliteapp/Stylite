<?php

class Model_Uploaditems extends \Orm\Model {

	public static $_table_name = 'items';

	protected static $_primary_key = array('item_id');

	public static $_properties = array(
		'item_id',
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

	public static function add($id, $filename)
	{
		$creation = static::forge(array(
			'user_id' 	=> $id,
			'filename'	=> $filename
		));
	
		$creation->save();
	
		return $creation;
	}

	public function get_item($size)
	{
		if (!in_array($size, array('s', 'l')))
		{
			throw new Exception("Invalid image size {$size}");	
		}

		return 'http://stylietapp.com/uploads/items/' . $size . '/' . $this->filename;
	}

	public static function get_item_filenames($userId)
	{
		$items = static::find()->where('user_id',$userId)->get();
		
		$output = array();
		foreach($items as $item)
		{
			array_push($output, $item->filename);
		}
		return $output;
	}
}