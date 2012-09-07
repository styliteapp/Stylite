<?php

class Controller_Api extends Controller_Rest
{
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

	public function post_newuser()
	{
		$signupObj = (object) array(
			'email'		=>	Input::post('email'),
			'password'	=>	Input::post('password'),
			'fName'		=>	Input::post('fName'),
			'lName'		=>	Input::post('lName'),
		);

		$created = Model_Newuser::add_user($signupObj->email);

		if (! $created)
		{
			$this->response(array(
				'success'	=>	false,
				'message'	=>	'invalid_signup',
			));
		}

		$this->response(array(
			'success'	=>	true,
			'message'	=>	'new_user created',
		));
	}
}