<?php

class Model_Uploadstyleboards extends \Orm\Model {

	public static $_table_name = 'styleboards';

	protected static $_primary_key = array('styleboard_id');

	public static $_properties = array(
		'styleboard_id',
		'user_id',
		'title',
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

	public static function add($title, $id, $filename)
	{
		$creation = static::forge(array(
			'title'		=> $title,
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

	public static function get_styleboard_filenames()
	{
		$styleboards = static::find()->get();
		
		$output = array();
		foreach($styleboards as $styleboard)
		{
			array_push($output, array('filename'=>$styleboard->filename,'title'=>$styleboard->title));
		}
		return $output;
	}
}