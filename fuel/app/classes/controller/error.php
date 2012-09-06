<?php

class Controller_Error extends Controller
{
	/**
	 * The 404 action for the application.
	 * 
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(View::forge('404'), 404);
	}
}