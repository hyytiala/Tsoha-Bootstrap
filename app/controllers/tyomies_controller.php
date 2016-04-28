<?php
	
	
	class TyomiesController extends BaseController
	{
		
		public static function index(){
			//self::check_logged_in();
			$tyomiehet = Tyomies::all();
			View::make('tyomies/index.html', array('tyomiehet' => $tyomiehet, 'session'=>$_SESSION['kayttaja']));
		}

		public static function show($id){
			//self::check_logged_in();
			$asiakas = Asiakas::find($id);
			View::make('tyomies/show.html', array('asiakas'=>$asiakas,));
		}

		public static function create(){
			//self::check_logged_in();
			View::make('tyomies/new.html');
		}

		public static function store(){
			$params = $_POST;
			if (!isset($params['admin'])){
				$admin = 'false';
			}else{
				$admin = $params['admin'];
			}
			$attributes = array(
				'nimi' => $params['nimi'],
				'puhelin' => $params['puhelin'],
				'salasana' => $params['salasana'],
				'kayttaja' => $params['kayttaja'],
				'admin' => $admin
				);

			$tyomies = new Tyomies($attributes);
			//$errors = $tyomies->errors();
			$errors = array_merge($tyomies->errors(), $tyomies->validate_salasana());

			if(count($errors) == 0){
				$tyomies->save();
				Redirect::to('/tyomies', array('message' => 'Henkilö on lisätty'));

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
			if (!isset($params['admin'])){
				$admin = 'false';
			}else{
				$admin = $params['admin'];
			}
			$attributes = array(
				'id' => $id,
				'nimi' => $params['nimi'],
				'puhelin' => $params['puhelin'],
				'kayttaja' => $params['kayttaja'],
				'admin' => $admin
				);

			$tyomies = new Tyomies($attributes);
			$errors = $tyomies->errors();

			if(count($errors) == 0){
				$tyomies->update();
				Redirect::to('/tyomies', array('message' => 'Henkilö on päivitetty'));

			}else{
				View::make('tyomies/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function destroy($id){
			self::check_logged_in();
    		$tyomies = new Tyomies(array('id' => $id));
    		$tyomies->poista_merkinnat();
			$tyomies->destroy();
    		Redirect::to('/tyomies', array('message' => 'Henkilö on poistettu!'));
    	}

		public static function nollaa_tunnit($id){
			self::check_logged_in();
			$tyomies = Tyomies::find($id);
			$tyomies->nollaa_tunnit();
			Redirect::to('/tyomies', array('message' => 'Tunnit nollattu!'));
		}
	}