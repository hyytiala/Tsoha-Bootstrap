<?php
	
	
	class KohteetController extends BaseController
	{
		
		public static function index(){
            self::check_logged_in();
			$kohteet = Kohde::all();
			View::make('kohde/index.html', array('kohteet' => $kohteet));
		}

		public static function show($id){
            self::check_logged_in();
            $merkinnat = Merkinta::all($id);
			$kohde = Kohde::find($id);
			View::make('kohde/show.html', array('kohde'=>$kohde, 'merkinnat' => $merkinnat));
		}

        public static function tarkastele($id){
            $kohde = Kohde::find($id);
            $merkinnat = Merkinta::all($id);
            if ($kohde != null){
                if ($kohde->katselu()){
                View::make('kohde/katselu.html', array('kohde'=>$kohde, 'merkinnat' => $merkinnat));
            }
        }
                Redirect::to('/tarkastele', array('error' => 'Kohdetta ei löydy!'));
            
        
        }


		public static function create(){
            self::check_logged_in();
            $asiakkaat = Asiakas::all();
            View::make('kohde/new.html', array('asiakkaat' => $asiakkaat));
    	}

    	public static function store(){
    		$params = $_POST;
    		$attributes = array(
    			'osoite' => $params['osoite'],
    			'aloitettu' => $params['aloitettu'],
    			'kuvaus' => $params['kuvaus'],
    			'katselu' => $params['katselu'],
    			'nimi' => $params['nimi'],
    		);

            $kohde = new Kohde($attributes);
            $errors = $kohde->errors();

            if(count($errors) == 0){
                $kohde->save();
                Redirect::to('/kohde/' . $kohde->id, array('message' => 'Kohde on lisätty kirjastoosi!'));

            }else{
                $asiakkaat = Asiakas::all();
                View::make('kohde/new.html', array('errors' => $errors, 'attributes' => $attributes, 'asiakkaat' => $asiakkaat));
            }    		
    	}
	}