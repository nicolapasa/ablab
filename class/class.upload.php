<?php
/*
 * classe per gestire l'upload
 * @author npasa
 */


Class Upload
{


     /**
      *
      * costruttore della classe accetta come argomenti directory, nome del file,
      *  massima dimensione consentita
      *
      */
	public function __construct($nomefile=null, $dir=DIR_UPLOAD, $max=25000000){

		//$file_name=Utility::sanitizeFile($_FILES[$nomefile]['name']);
	if(isset($_FILES[$nomefile]['name']) and $_FILES[$nomefile]['name']!=''){ //se esiste allora elaboro
		$file_name=Utility::renameFile($_FILES[$nomefile]['name']);
		$uploadfile = $dir . basename($file_name);
		$error='';
		if($_FILES[$nomefile]['size']<$max ) {

			if(preg_match('/(html|JPG|jpg|jpeg|gif|png|gif|pdf|doc|txt|docx|xls|xlsx|bmp)$/',$file_name)){

				if (move_uploaded_file($_FILES[$nomefile]['tmp_name'], $uploadfile)  ) {

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
		$info=$_FILES['error'];
		if($error!='')	Err::addErr('upload', 'errore', $error, $info);



	  }
	}//if se non esiste il file
}
