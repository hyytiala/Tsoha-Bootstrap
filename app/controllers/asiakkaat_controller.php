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
			$attributes = array(
				'nimi' => $params['nimi'],
				'osoite' => $params['osoite'],
				'postinumero' => $params['postinumero'],
				'postipaikka' => $params['postipaikka'],
				'puhelin' => $params['puhelin'],
				'email' => $params['email']
				);

			$asiakas = new Asiakas($attributes);
			$errors = $asiakas->errors();

			if(count($errors) == 0){
				$asiakas->save();
				Redirect::to('/asiakas/' . $asiakas->id, array('message' => 'Asiakas on lisätty'));
			}else{
				View::make('asiakas/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function edit($id){
			$asiakas = Asiakas::find($id);
			View::make('asiakas/edit.html', array('attributes' => $asiakas));
		}

		public static function update($id){
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'nimi' => $params['nimi'],
				'osoite' => $params['osoite'],
				'postinumero' => $params['postinumero'],
				'postipaikka' => $params['postipaikka'],
				'puhelin' => $params['puhelin'],
				'email' => $params['email']
				);

			$asiakas = new Asiakas($attributes);
			$errors = $asiakas->errors();

			if(count($errors) == 0){
				$asiakas->update();
				Redirect::to('/asiakas/' . $asiakas->id, array('message' => 'Asiakas on päivitetty'));
			}else{
				View::make('asiakas/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}

		public static function destroy($id){
    		$asiakas = new Asiakas(array('id' => $id));
    		$nro = $asiakas->kohteissa($id);
    		if($nro == 0){
				$asiakas->destroy();
    			Redirect::to('/asiakas', array('message' => 'Asiakas on poistettu!'));
			}else{
				$errors = 'Asiakkaalla aktiivisia kohteita';
				Redirect::to('/asiakas', array('error' => 'Asiakkaalla on aktiivisia kohteita. Poisto ei sallittu!'));
			}
    		
  		}

	}