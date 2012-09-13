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
	 	$config = array(
		    'path' => DOCROOT.'uploads/l',
		    'randomize' => true,
		    'ext_whitelist' => array('jpg', 'jpeg', 'png'),
		);

		Upload::process($config);

		if( Upload::is_valid() ){
			Upload::save();

			Model_Upload::add($id, Upload::get_files());

			$this->response(array(
				'success'	=> true,
				'message'	=> 'good.'
			));
		}elseif( !Upload::is_valid() ){
			$this->response(array(
				'success'	=> false,
				'message'	=> 'bad.'
			));
		}
 	}
}