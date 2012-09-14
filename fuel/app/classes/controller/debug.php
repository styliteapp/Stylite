<?php

class Controller_Debug extends Controller
{
	public function action_logs($year = null, $month = null, $day = null)
	{
		$date = date("Y/m/d");

		if (Fuel::$env == Fuel::PRODUCTION) $path = '/var/www/styliteapp.com';
		if (Fuel::$env == Fuel::DEVELOPMENT) $path = '/Users/grantes/Sites/Stylite_app';

		$input = file($path . '/fuel/app/logs/' . $date . '.php');

		return Response::forge(View::forge('debug/logs', array(
			'logs' => array_reverse($input),
		)));
		
	}

	public function action_ajax()
	{
		return Respone::forge(View:forge('debug/ajax'));
	}
}