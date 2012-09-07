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
		$signupObj = Input::post('signupObj');
		$this->response(array(
			'success'	=>	true,
			'message'	=>	$signupObj,
		));
	}
}