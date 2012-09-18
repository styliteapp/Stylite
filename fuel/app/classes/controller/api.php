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
 * UPLOAD new item image from closet
 *
 */
 	public function post_imageUpload()
 	{
		$imgName= md5(rand().time());
		$imgData= base64_decode(Input::post('base64'));
		$success= file_put_contents(DOCROOT.'uploads/items/l/'.$imgName.'.jpg', $imgData);
	
		if( !$success ){
			$this->response(array(
				'success'	=> false,
				'message'	=> 'bad upload'
			));
		}else{
			Image::load(DOCROOT.'uploads/items/l/'.$imgName.'.jpg')->resize('7.7160494%', '7.7160494%')->save(DOCROOT.'uploads/items/s/'.$imgName.'.jpg');
			$dbSave = Model_Uploaditems::add(Input::post('user_id'), $imgName.'.jpg');
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
			'message'	=> 'good upload'
		));
 	}

/**
 *
 * UPLOAD new styleboard from create screen
 *
 */
 	public function post_styleboardUpload()
 	{
		$imgName= md5(rand().time());
		$encodedData= str_replace(' ','+',Input::post('base64'));
		$imgData= base64_decode($encodedData);
		$success= file_put_contents(DOCROOT.'uploads/styleboards/l/'.$imgName.'.png', $imgData);
	
		if( !$success ){
			$this->response(array(
				'success'	=> false,
				'message'	=> 'bad upload'
			));
		}else{
			Image::load(DOCROOT.'uploads/styleboards/l/'.$imgName.'.png')->resize('400', '400')->save(DOCROOT.'uploads/styleboards/s/'.$imgName.'.png');
			$dbSave = Model_Uploadstyleboards::add(Input::post('user_id'), $imgName.'.png');
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
			'message'	=> 'good upload'
		));
 	}

/**
 *
 * RETRIEVE user's closet items for create screen
 *
 */
 	public function post_getSmallItems()
 	{
	 	$smItems = Model_UploadItems::get_item_filenames(Input::post('user_id'));
	 	
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