<?php
	
	
	class MerkintaController extends BaseController
	{
		

		public static function create($id){
            self::check_logged_in();
            $kohde = Kohde::find($id);
            if (self::admin()){
                $tyomiehet = Tyomies::all();
                View::make('merkinta/admin_new.html', array('kohde'=>$kohde, 'tyomiehet'=>$tyomiehet));
            }else{
                View::make('merkinta/new.html', array('kohde'=>$kohde));
            }
        }

    	public static function store(){
    		$params = $_POST;
            if (!isset($params['nimi'])){
                $tid = $_SESSION['kayttaja'];
            }else{
                $tid = $params['nimi'];
            }
    		$attributes = array(
    			'kuvaus' => $params['kuvaus'],
                'nimi' => $tid,
    			'tunnit' => $params['tunnit'],
    			'kohde' => $params['kohde']
    			);

            $merkinta = new Merkinta($attributes);
            $errors = $merkinta->errors();
            $tyomies = Tyomies::find($tid);
            $tunnit = $tyomies->tunnit + $params['tunnit'];

            if(count($errors) == 0){
                $merkinta->save();
                $tyomies->save_tunnit($tunnit);
                Redirect::to('/kohde/' . $params['kohde'], array('message' => 'Merkintä lisätty'));

            }else{
                $id = $params['kohde'];
                $kohde = Kohde::find($id);
                View::make('merkinta/new.html', array('kohde'=>$kohde,'errors' => $errors, 'attributes' => $attributes));
            }
    	}

        public static function admin_store(){
            $params = $_POST;
            $attributes = array(
                'kuvaus' => $params['kuvaus'],
                'nimi' => $params['nimi'],
                'tunnit' => $params['tunnit'],
                'kohde' => $params['kohde']
                );

            $merkinta = new Merkinta($attributes);
            $errors = $merkinta->errors();
            $tyomies = Tyomies::find($params['nimi']);
            $tunnit = $tyomies->tunnit + $params['tunnit'];

            if(count($errors) == 0){
                $merkinta->save();
                $tyomies->save_tunnit($tunnit);
                Redirect::to('/kohde/' . $params['kohde'], array('message' => 'Merkintä lisätty'));

            }else{
                $id = $params['kohde'];
                $kohde = Kohde::find($id);
                View::make('merkinta/new.html', array('kohde'=>$kohde,'errors' => $errors, 'attributes' => $attributes));
            }
        }

        public static function destroy($id){
            self::check_logged_in();
            $merkinta = new Merkinta(array('id' => $id));
            $kohdeid = Merkinta::find($id);
            $kohde = $kohdeid->kohde;
            $merkinta->destroy();
            Redirect::to('/kohde/' . $kohde, array('message' => 'Merkintä on poistettu!'));            
        }
	}