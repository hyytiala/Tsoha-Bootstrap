<?php
	
	
	class MerkintaController extends BaseController
	{
		

		public static function create($id){
            self::check_logged_in();
            $tyomiehet = Tyomies::all();
            $kohde = Kohde::find($id);
            View::make('merkinta/new.html', array('kohde'=>$kohde, 'tyomiehet'=>$tyomiehet));
        }

    	public static function store(){
    		$params = $_POST;
    		$merkinta = new Merkinta(array(
    			'kuvaus' => $params['kuvaus'],
                'nimi' => $_SESSION['kayttaja'],
    			'tunnit' => $params['tunnit'],
    			'kohde' => $params['kohde']
    			));


    		$merkinta->save();

    		Redirect::to('/kohde/' . $params['kohde'], array('message' => 'Kohde on lisätty kirjastoosi!'));

    	}
	}