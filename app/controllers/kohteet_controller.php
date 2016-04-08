<?php
	
	
	class KohteetController extends BaseController
	{
		
		public static function index(){
			$kohteet = Kohde::all();
			View::make('kohde/index.html', array('kohteet' => $kohteet));
		}
	}