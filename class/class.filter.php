<?php 
define('FILTER_FAILURE', null); // null o false
/*
 * classe che effettua la sanificazione delle variabili  post e get sulla mappatura di campi 
 * campi standard nome cognome email username password indirizzo cap telefono cell cf piva rag_soc numero_civico
 * campi aggiuntivi dipendono dal sito
 * @author npasa
 */

Class Filter
{

public	$args = array(
		
			//'username' => FILTER_SANITIZE_STRING,
		    'username'   => FILTER_SANITIZE_STRING,
		    'password' => FILTER_SANITIZE_STRING,
		    'referente' => FILTER_SANITIZE_STRING,
			'nome' => FILTER_SANITIZE_STRING,
		    'cognome' => FILTER_SANITIZE_STRING,
		    'indirizzo' => FILTER_SANITIZE_STRING,
		    'cap'   => FILTER_SANITIZE_NUMBER_INT,
			'email'   => FILTER_SANITIZE_EMAIL,
		    'testo'  =>FILTER_SANITIZE_STRING,
		    'numero_civico'=>FILTER_SANITIZE_STRING,
		    'telefono'=>FILTER_SANITIZE_STRING,
		    'cell'=>FILTER_SANITIZE_STRING
	
	);
public	$noempty = array(

		'username',  
		'password', 
		'referente' ,
		'nome' ,
		'indirizzo',
		'cap' ,
		'provincia'  ,
		'comune'  ,
		'telefono',
		'piva',
		'cf'

);
/*
 * 
 *costruttore che  esegue la chiamata ai filtri di default assume che l'input sia di tipo post
 * può ricevere INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, or INPUT_ENV.
 */	
	public function filter_data($a){
	    
	//return	filter_var_array($a, $this->args);
	foreach ($a as $key => $value) {
	     
		
		if(array_key_exists($key, $this->args)){
		$a[$key] = filter_var($value, $this->args[$key]);
		}
		else{
			if(is_array($value)){
				$a[$key]=self::filter_data($value);
			}	
			else{
			//se key non è in args allora filtro genericamente con string
		    $a[$key]= filter_var($value, FILTER_SANITIZE_STRING);
			}
		}
	    
	}
		
	return $a;
	}
	
	
	public function filter_empty($a){
		 $valid=true;
		//return	filter_var_array($a, $this->args);
		foreach ($a as $key => $value) {
	
	              
			if(in_array($key, $this->noempty)){
			
			 if($value =='' ) {$valid=false;}
			}

		  
		}
	
		return $valid;
	}
	/**
	 *
	 * Esegue il filtraggio, se positivo ritorna una data ben formattata formata nello standard 'Y-m-d'
	 * @param string $s
	 * @return string|FILTER_FAILURE
	 */
	function filter_date($s) // FIXME maurizio: si riesce ad usare il LOCALE?
	{
		$d = $m = $y = null;
		$a = array();
		if ( preg_match_all('/^([0-9]{1,2})[\/\.-]([0-9]{1,2})[\/\.-](19[0-9]{2}|20[0-9]{2})$/', $s, $a) ) {
			$d = (int)$a[1][0];
			$m = (int)$a[2][0];
			$y = (int)$a[3][0];
		}
		if ( $d && $m && $y && checkdate($m, $d, $y) ) {
			return date('d/m/Y', mktime(0, 0, 0, $m, $d, $y));
		}
		return FILTER_FAILURE;
	}
 
}	