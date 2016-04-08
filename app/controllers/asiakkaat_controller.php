<?php
	
	
	class AsiakkaatController extends BaseController
	{
		
		public static function index(){
			$asiakkaat = Asiakas::all();
			View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
		}
	}