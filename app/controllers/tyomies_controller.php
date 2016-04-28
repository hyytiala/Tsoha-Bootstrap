<?php
	
	
	class TyomiesController extends BaseController
	{
		
		public static function index(){
			self::check_logged_in();
			$tyomiehet = Tyomies::all();
			View::make('tyomies/index.html', array('tyomiehet' => $tyomiehet));
		}

		public static function show($id){
			self::check_logged_in();
			$asiakas = Asiakas::find($id);
			View::make('tyomies/show.html', array('asiakas'=>$asiakas));
		}

		public static function create(){
			self::check_logged_in();
			View::make('tyomies/new.html');
		}

		public static function store(){
			$params = $_POST;
			$attributes = array(
				'nimi' => $params['nimi'],
				'puhelin' => $params['puhelin'],
				'salasana' => $params['salasana'],
				'kayttaja' => $params['kayttaja']
				);

			$tyomies = new Tyomies($attributes);
			//$errors = $tyomies->errors();
			$errors = array_merge($tyomies->errors(), $tyomies->validate_salasana());

			if(count($errors) == 0){
				$tyomies->save();
				Redirect::to('/tyomies', array('message' => 'Työntekijä on lisätty'));

			}else{
				View::make('tyomies/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function edit($id){
    		$tyomies = Tyomies::find($id);
    		View::make('tyomies/edit.html', array('attributes' => $tyomies));
		}

		public static function update($id){
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'nimi' => $params['nimi'],
				'puhelin' => $params['puhelin'],
				'kayttaja' => $params['kayttaja'],
				);

			$tyomies = new Tyomies($attributes);
			$errors = $tyomies->errors();

			if(count($errors) == 0){
				$tyomies->update();
				Redirect::to('/tyomies', array('message' => 'Työntekijä on päivitetty'));

			}else{
				View::make('tyomies/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}
	}