<?php

class Controller_Api extends Controller_Rest
{
	public function post_signup()
	{
		$post = (object) array(
			'email' => Input::post('email'),
		);

		$subscription = Model_Signup::forge(array(
			'email' => $post->email,
		));

		$subscription->save();

		$this->response(array(
			'success' => true,
			'message' => 'email_subscribed',
		));
	}
}