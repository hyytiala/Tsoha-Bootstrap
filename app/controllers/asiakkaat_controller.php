<?php
	
	
	class AsiakkaatController extends BaseController
	{
		
		public static function index(){
			$asiakkaat = Asiakas::all();
			View::make('asiakas/index.html', array('asiakkaat' => $asiakkaat));
		}

		public static function show($id){
			$asiakas = Asiakas::find($id);
			View::make('asiakas/show.html', array('asiakas'=>$asiakas));
		}

		public static function create(){
			View::make('asiakas/new.html');
		}

		public static function store(){
			$params = $_POST;
			$asiakas = new Asiakas(array(
				'nimi' => $params['nimi'],
				'osoite' => $params['osoite'],
				'postinumero' => $params['postinumero'],
				'postipaikka' => $params['postipaikka'],
				'puhelin' => $params['puhelin'],
				'email' => $params['email']
				));


			$asiakas->save();

			Redirect::to('/asiakas/' . $asiakas->id, array('message' => 'Asiakas on lisätty'));

			}
	}