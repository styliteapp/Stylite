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
	 	//$base64	= Input::post('base64');
	 	$id		= Input::post('user_id');
	 	/*$lName	= Input::post('user_lName');
	 	$imgName= $lName.$id.'_'.time();
	 	$imgData= base64_decode($base64);
	 	$success= file_put_contents(DOCROOT.'uploads/l/'.$imgName.'.jpg', $imgData);

	 	if( !$success ){
		 	$this->response(array(
	 			'success'	=> false,
	 			'message'	=> 'bad upload'
	 		));
	 	}

	 	$dbSave = Model_Upload::add($id, $imgName.'.jpg', 'l');

	 	if( ! $dbSave )
	 	{
		 	$this->response(array(
	 			'success'	=> false,
	 			'message'	=> 'bad upload'
	 		));
	 	}

	 	$this->response(array(
	 		'success'	=> true,
	 		'message'	=> 'http://styliteapp.com/uploads/l/'.$imgName.'.jpg'
	 	));*/
	 	
	 	
	 	
	 	
	 	// Custom configuration for this upload
		$config = array(
		    'path' => DOCROOT.DS.'uploads/l',
		    'randomize' => true,
		    'ext_whitelist' => array('jpg', 'jpeg', 'png'),
		);
		
		// process the uploaded files in $_FILES
		Upload::process($config);
		
		// if there are any valid files
		if (Upload::is_valid())
		{
		    Upload::save();
		
		    Model_Upload::add($id, Upload::get_files());
		    
		    $this->response(array(
	 			'success'	=> true,
	 			'message'	=> 'yes!!! upload'
	 		));
		}
		
		elseif ( ! Upload::is_valid())
		{
			$this->response(array(
	 			'success'	=> false,
	 			'message'	=> 'not today'
	 		));
		}
		
		// and process any errors
		foreach (Upload::get_files() as $file)
		{
		    
		}
 	}
}