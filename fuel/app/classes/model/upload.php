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

	public static function add($id, $files)
	{
		$uploads = array();
		foreach ($files as $file)
		{
			list($filename, $extension) = explode('.', $file['saved_as']);
				
			//Image::load('filename.gif')
			//	->config('bgcolor', '#f00')
			//	->resize(100, 100, true, true);
			
			$upload = static::forge(array(
				'user_id' 	=> $id,
				'filename'	=> $file['saved_as'],
			));
			
			$upload->save();
			
			array_push($uploads, $upload)
		}
		
		return $uploads;
	}

	public function get_image($size)
	{
		if (!in_array($size, array('s', 'l')))
		{
			throw new Exception("Invalid image size {$size}");	
		}

		return 'http://stylietapp.com/uploads/' . $size . '/' . $this->filename;
	}
}