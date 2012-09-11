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

		$created = Model_User::add_user($signupObj->email, $signupObj->password, $signupObj->fName, $signupObj->lName);

		if (! $created)
		{
			$this->response(array(
				'success'	=>	false,
				'message'	=>	'invalid_signup',
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
	 		'user'		=>	$user->last_name;
	 	));
 	}
}