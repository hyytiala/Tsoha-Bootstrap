<?php
	
	
	class TyomiesController extends BaseController
	{
		
		public static function index(){
			$tyomiehet = Tyomies::all();
			View::make('tyomies/index.html', array('tyomiehet' => $tyomiehet));
		}

		public static function show($id){
			$asiakas = Asiakas::find($id);
			View::make('tyomies/show.html', array('asiakas'=>$asiakas));
		}

		public static function create(){
			View::make('tyomies/new.html');
		}

		public static function store(){
			$params = $_POST;
			$tyomies = new Tyomies(array(
				'nimi' => $params['nimi'],
				'puhelin' => $params['puhelin'],
				'salasana' => $params['salasana'],
				'kayttaja' => $params['kayttaja']
				));


			$tyomies->save();

			Redirect::to('/tyomies', array('message' => 'Työntekijä on lisätty'));

			}
	}