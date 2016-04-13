<?php
	
	
	class KohteetController extends BaseController
	{
		
		public static function index(){
			$kohteet = Kohde::all();
			View::make('kohde/index.html', array('kohteet' => $kohteet));
		}

		public static function show($id){
			$kohde = Kohde::find($id);
			View::make('kohde/show.html', array('kohde'=>$kohde));
		}

		public static function create(){
        $asiakkaat = Asiakas::all();
        View::make('kohde/new.html', array('asiakkaat' => $asiakkaat));
    	}

    	public static function store(){
    		$params = $_POST;
    		$kohde = new Kohde(array(
    			'osoite' => $params['osoite'],
    			'aloitettu' => $params['aloitettu'],
    			'kuvaus' => $params['kuvaus'],
    			'katselu' => $params['katselu'],
    			'nimi' => $params['nimi'],
    			));

    		

    		$kohde->save();

    		Redirect::to('/kohde/' . $kohde->id, array('message' => 'Kohde on lisätty kirjastoosi!'));

    	}
	}