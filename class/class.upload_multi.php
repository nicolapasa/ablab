<?php
/*
 * classe per gestire l'upload multiplo
 * @author npasa
 */


Class Upload_multi
{


     /**
      *
      * costruttore della classe accetta come argomenti directory, nome del file,
      *  massima dimensione consentita
      *
      */
	public function __construct($nomefile=null,$i=0, $dir=DIR_UPLOAD, $max=25000000){

		if(isset($_FILES[$nomefile]['name'][$i]) and $_FILES[$nomefile]['name'][$i]!=''){ //se esiste allora elaboro
			$file_name=Utility::renameFile($_FILES[$nomefile]['name'][$i]);

		$uploadfile = $dir . basename($file_name);
		$error='';
		if($_FILES[$nomefile]['size'][$i]<$max ) {

			if(preg_match('/(PDF|JPG|jpg|jpeg|gif|png|gif|pdf|doc|txt|docx|xls|xlsx|bmp)$/',$file_name)){

				if (move_uploaded_file($_FILES[$nomefile]['tmp_name'][$i], $uploadfile)  ) {

					$_POST[$nomefile]=$file_name;
				} else {
					$error= "Possibile attacco tramite file upload!\n";


				}

			}else {

				$error= 'estensione non valida';
			}


		}else{

			//
			$error=  'dimensioni file eccessive';
		}
		// salvo nei log le informazioni di debug
		$info=$file_name;
		if($error!='')	Err::addErr('upload', 'errore', $error, $info);



	 }
	}
}
