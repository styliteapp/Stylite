<?php

class Controller_Api extends Controller_Rest
{
/**
 *
 * E-SIGNUP on styliteapp.com
 *
 */
	public function post_signup()
	{
		$post = (object) array(
			'email' => Input::post('email'),
		);

		$subscribed = Model_Signup::add_email($post->email);

		if (! $subscribed)
		{
			$this->response(array(
				'success' => false,
				'message' => 'invalid_email',
			));
			return;
		}

		$this->response(array(
			'success' => true,
			'message' => 'email_subscribed',
		));
	}

/**
 *
 * New user SIGNUP on the Stylite iPad app
 *
 */
	public function post_register()
	{
		$signupObj = (object) array(
			'email'		=>	Input::post('email'),
			'password'	=>	Input::post('password'),
			'fName'		=>	Input::post('fName'),
			'lName'		=>	Input::post('lName'),
		);

		$created = Model_User::add_user(
			$signupObj->email,
			$signupObj->password,
			$signupObj->fName,
			$signupObj->lName
		);

		if (! $created)
		{
			$this->response(array(
				'success'	=> false,
				'message'	=> 'invalid_signup',
			));
		}

		$this->response(array(
			'success'	=>	true,
			'message'	=>	$signupObj->fName.' '.$signupObj->lName.' created',
		));
	}

/**
 *
 * user LOGIN on the Stylite iPad app
 *
 */
 	public function post_login()
 	{
	 	$loginObj = (Object) array(
	 		'email'		=>	Input::post('email'),
	 		'password'	=>	Input::post('password'),
	 	);

	 	$user = Model_User::log_in($loginObj->email, $loginObj->password);

	 	if (! $user)
	 	{
		 	$this->response(array(
		 		'success'	=>	false,
		 		'message'	=>	'invalid_login',
		 	));
	 	}

	 	$this->response(array(
	 		'success'	=>	true,
	 		'user'		=>	array(
	 			'id'		=> $user->id,
	 			'email'		=> $user->email,
	 			'first_name'=> $user->first_name,
	 			'last_name'	=> $user->last_name
	 		)
	 	));
 	}

/**
 *
 * UPLOAD new closet item image
 *
 */
 	public function post_imageUpload()
 	{
		$imgName= md5(rand().time());
		$imgData= base64_decode(Input::post('base64'));
		$success= file_put_contents(DOCROOT.'uploads/l/'.$imgName.'.jpg', $imgData);
	
		if( !$success ){
			$this->response(array(
				'success'	=> false,
				'message'	=> 'bad upload'
			));
		}else{
			Image::load(DOCROOT.'uploads/l/'.$imgName.'.jpg')->resize('7.7160494%', '7.7160494%')->save(DOCROOT.'uploads/s/'.$imgName.'.jpg');
			$imgSizes = Image::sizes(DOCROOT.'uploads/s/'.$imgName.'.jpg');
			$imgSize = ($imgSizes->width > $imgSizes->height) ? 'landscape' : 'portrait';
			$dbSave = Model_Upload::add(Input::post('user_id'), $imgName.'.jpg', $imgSize);
		}
	
		if( ! $dbSave )
		{
			$this->response(array(
				'success'	=> false,
				'message'	=> 'bad upload'
			));
		}
	
		$this->response(array(
			'success'	=> true,
			'message'	=> $imgSizes->width
		));
 	}

 	public function post_getSmallItems()
 	{
	 	$smItems = Model_Upload::get_item_filenames(Input::post('user_id'));
	 	
	 	if( empty($smItems) )
	 	{
	 		$this->response(array(
			 	'success'	=> false,
			 	'message'	=> 'there were probs, yo',
			));
	 	}else{
		 	$this->response(array(
		 		'success'	=> true,
		 		'images'	=> $smItems
	 		));
	 	}
 	}
}