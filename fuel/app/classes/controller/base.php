<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Base extends Controller_Template
{
	public function before()
	{
		parent::before();
		
		$this->init_js();
	}
	
	
	private function init_js()
	{
		if (Fuel::$env == Fuel::DEVELOPMENT)
		{
			Casset::js('stylite_dev.js');
		}
		else
		{
			Casset::js('stylite.js');
		}
	}
}