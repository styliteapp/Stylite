<?php

class Model_Uploadstyleboards extends \Orm\Model {

	public static $_table_name = 'styleboards';

	protected static $_primary_key = array('styleboard_id');

	public static $_properties = array(
		'styleboard_id',
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

	public function get_styleboard($size)
	{
		if (!in_array($size, array('s', 'l')))
		{
			throw new Exception("Invalid image size {$size}");	
		}

		return 'http://stylietapp.com/uploads/styleboards/' . $size . '/' . $this->filename;
	}

	public static function get_styleboard_filenames($userId)
	{
		$styleboards = static::find()->where('user_id',$userId)->get();
		
		$output = array();
		foreach($styleboards as $styleboard)
		{
			array_push($output, $styleboard->filename);
		}
		return $output;
	}
}