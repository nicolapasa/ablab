<?php

/*
 * classe che effettua la ripulitura dei dati con varie funzioni
 * @author npasa
 */

Class Clear
{



	 public function pulisci($a){


	foreach ($a as $key => $value) {


		       if(is_array($value)){

		       	self::pulisci($value);
		       }
		       else{
				//$a[$key] =stripslashes( mb_strtolower($value, 'UTF-8'));
				$a[$key] =stripslashes($value);

		       }


	}

	return $a;
	}


/*metodo che pubblica i caratteri speciali */
public function htmlspecialchars_array($a){


foreach ($a as $key => $value) {


				if(is_array($value)){

				 self::htmlspecialchars_array($value);
				}
				else{
		 //$a[$key] =stripslashes( mb_strtolower($value, 'UTF-8'));
		 if(is_string($value)) $a[$key] =htmlspecialchars($value);

				}


}

return $a;
}


}
