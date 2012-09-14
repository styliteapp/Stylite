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

	public static function add($id, $filename)
	{
		$creation = static::forge(array(
			'user_id' 	=> $id,
			'filename'	=> $filename
		));
	
		$creation->save();
	
		return $creation;
	}

	public function get_image($size)
	{
		if (!in_array($size, array('s', 'l')))
		{
			throw new Exception("Invalid image size {$size}");	
		}

		return 'http://stylietapp.com/uploads/' . $size . '/' . $this->filename;
	}

	public static function get_item_filenames($userId)
	{
		$images = static::find()->where('user_id',$userId)->get();
		
		$output = array();
		foreach($images as $image)
		{
			//array_push($output, $image->filename);
			$small_filename = $image->filename;
			$image_object = (Object) array('filename'=>$image->filename);
		}
		return $image_object;
	}
}