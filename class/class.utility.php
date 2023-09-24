<?php
session_start();
/*
 * raccolta di funzioni
 * @author npasa
 */
//require_once('__ROOT__./../PHPMailer-master/src/PHPMailer.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '__ROOT__./../PHPMailer-master/src/Exception.php';
require '__ROOT__./../PHPMailer-master/src/PHPMailer.php';
require '__ROOT__./../PHPMailer-master/src/SMTP.php';
Class Utility
{


public	function inviaMail($email, $oggetto, $testo, $pdf=null, $pdf2=null){

		$db=new DB();

		$mail = new PHPMailer();
				$mail->Port = 587;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";
			$mail->Username = MAIL_USER;
		//Password to use for SMTP authentication
		$mail->Password = MAIL_PASS;


		$mail->SMTPKeepAlive = true;
       $mail->Mailer = "smtp";
		$mail->IsSMTP();

		$mail->Host = MAIL_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587

		$mail->CharSet = "UTF-8";



		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		$mail->setFrom(MAIL_FROM, MAIL_NOME);

		$mail->addReplyTo(MAIL_REPLY, MAIL_NOME);
		// Set PHPMailer to use the sendmail transport
		//Set who the message is to be sent to
		$mail->addAddress($email);
		//Set the subject line
		$mail->Subject = $oggetto;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually

		//cerco eventuali immagini nel testo



		$mail->Body = $testo;
		$mail->IsHTML(true);
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
     if($pdf!=''){


			//check se immagine o pdf
            // if(Utility::is_image($pdf)) {

			// 	$mail->AddAttachment($pdf, $pdf_name,  'base64', 'application/jpg');
			// }
			// else{
			// 	$mail->AddAttachment($pdf, $pdf_name,  'base64', 'application/pdf');
			// }
			$mail->AddAttachment($pdf,   basename($pdf));
		    
		//$mail->AddAttachment($pdf, '2020-1169-Ambulatorio_Benedetti_Tiretta_E_Lazzeri',  'base64', 'application/pdf');

		//$mail->addStringAttachment($pdf, $pdf_name,  'base64', 'application/pdf');
	 }
		  if($pdf2!=''){
	    $mail->AddAttachment($pdf2, $pdf_name2,  'base64', 'application/pdf');
	 }
		//send the message, check for errors
		if (!$mail->send()) {
			$err= $mail->ErrorInfo;
			$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'errore', 'valore'=>$err, 'info'=>$email));
		}
		else{
				$err= $mail->ErrorInfo;
					$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'email inviata', 'valore'=>$err, 'info'=>$email));

		}

	}

	public	function inviaMailFatt($email, $oggetto, $testo, $pdf=null, $pdf2=null, $pdf_name=null, $pdf_name2){

		$db=new DB();

		$mail = new PHPMailer();
				$mail->Port = 587;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";
			$mail->Username = MAIL_USER;
		//Password to use for SMTP authentication
		$mail->Password = MAIL_PASS;


		$mail->SMTPKeepAlive = true;
       $mail->Mailer = "smtp";
		$mail->IsSMTP();

		$mail->Host = MAIL_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587

		$mail->CharSet = "UTF-8";



		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		$mail->setFrom(MAIL_AMMINISTRAZIONE, MAIL_NOME_AM);

		$mail->addReplyTo(MAIL_AMMINISTRAZIONE, MAIL_NOME_AM);
		// Set PHPMailer to use the sendmail transport
		//Set who the message is to be sent to
		$mail->addAddress($email);
		//Set the subject line
		$mail->Subject = $oggetto;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually

		//cerco eventuali immagini nel testo



		$mail->Body = $testo;
		$mail->IsHTML(true);
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
     if($pdf!=''){

		$mail->AddAttachment($pdf, $pdf_name,  'base64', 'application/pdf');
		//$mail->AddAttachment($pdf, '2020-1169-Ambulatorio_Benedetti_Tiretta_E_Lazzeri',  'base64', 'application/pdf');

		//$mail->addStringAttachment($pdf, $pdf_name,  'base64', 'application/pdf');
	 }
		  if($pdf2!=''){
	    $mail->AddAttachment($pdf2, $pdf_name2,  'base64', 'application/pdf');
	 }
		//send the message, check for errors
		if (!$mail->send()) {
			$err= $mail->ErrorInfo;
			$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'errore', 'valore'=>$err, 'info'=>$email));
		}
		else{
				$err= $mail->ErrorInfo;
					$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'email inviata', 'valore'=>$err, 'info'=>$email));

		}

	}
public	function inviaMailH($email, $oggetto, $testo, $pdf=null){

		$db=new DB();

		$mail = new PHPMailer();
				$mail->Port = 587;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		$mail->SMTPSecure = "tls";
			$mail->Username = MAIL_USER;
		//Password to use for SMTP authentication
		$mail->Password = MAIL_PASS;


		$mail->SMTPKeepAlive = true;
       $mail->Mailer = "smtp";
		$mail->IsSMTP();

		$mail->Host = MAIL_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587

		$mail->CharSet = "UTF-8";



		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		$mail->setFrom(MAIL_FROM, MAIL_NOME);

		$mail->addReplyTo(MAIL_REPLY, MAIL_NOME);
		// Set PHPMailer to use the sendmail transport
		//Set who the message is to be sent to
		$mail->addAddress($email);
		//Set the subject line
		$mail->Subject = $oggetto;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually

		//cerco eventuali immagini nel testohhh
		if($pdf!=''){


			//check se immagine o pdf
			$mail->AddAttachment($pdf,   basename($pdf));
			
	
		 }


		$mail->msgHTML(file_get_contents($testo), URLGEN.DIR_UPLOAD);
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');

		//send the message, check for errors
		if (!$mail->send()) {
			$err= $mail->ErrorInfo;
			$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'errore', 'valore'=>$err, 'info'=>$email));
		}
		else{
				$err= $mail->ErrorInfo;
					$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'email inviata', 'valore'=>$err, 'info'=>$email));

		}

	}

	public	function inviaMailTest($email, $oggetto, $testo, $pdf=null, $pdf2=null){

		$db=new DB();

		$mail = new PHPMailer();
				$mail->Port = 465;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Username = MAIL_USER;
		//Password to use for SMTP authentication
		$mail->Password = MAIL_PASS;


		$mail->SMTPKeepAlive = true;
       $mail->Mailer = "smtp";
		$mail->IsSMTP();

		$mail->Host = MAIL_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587

		$mail->CharSet = "UTF-8";



		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		$mail->setFrom(MAIL_FROM, MAIL_NOME);

		$mail->addReplyTo(MAIL_REPLY, MAIL_NOME);
		// Set PHPMailer to use the sendmail transport
		//Set who the message is to be sent to
		$mail->addAddress($email);
		//Set the subject line
		$mail->Subject = $oggetto;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually

		//cerco eventuali immagini nel testo



		$mail->Body = $testo;
		$mail->IsHTML(true);
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
     if($pdf!=''){
	    $mail->AddAttachment($pdf, $pdf_name,  'base64', 'application/pdf');
	 }
		  if($pdf2!=''){
	    $mail->AddAttachment($pdf2, $pdf_name2,  'base64', 'application/pdf');
	 }
		//send the message, check for errors
		if (!$mail->send()) {
			$err= $mail->ErrorInfo;
			$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'errore', 'valore'=>$err, 'info'=>$email));
		}
		else{
				$err= $mail->ErrorInfo;
					$db->add('error', array('time'=>time(),  'contesto'=>'invio mail',
			'tipo'=>'email inviata', 'valore'=>$err, 'info'=>$email));

		}

	}
/*
metodo per verificare se file immagine
*/
public	function is_image($path)
{
	
	$image_type = pathinfo($path, PATHINFO_EXTENSION);
	
	if(in_array($image_type , array('jpg' , 'png' , 'bmp' )))
	{
		return true;
	}
	return false;
}
/*
metodo che
*/

 public function caratteriSpeciali($t){

	return nl2br(ucfirst(htmlentities($t)));

//return nl2br(ucfirst(strip_tags($t)));

 }


	/*
	controllo formale codice univoco 7 caratteri alfanumerici
	* es 1 diventa 00001 10 diventa 00010
	*/
	public function checkCod($cod){

		$pass=true;

		  if(strlen($cod)!=7) $pass=false;
		 if(!preg_match("^[a-zA-Z0-9]+$", $cod)) $pass=false;
		 if($pass==true) {
			 return $cod;
		 }else{
			 return '';
		 }

	}
	/*
	metodo che valorizza mettendo degli zero
	* es 1 diventa 00001 10 diventa 00010
	*/
	public function mettiZero($tot=5, $num){


		 $q=$tot-strlen($num);
		 $temp='';
		$c=0;
		while($c<$q){

			$temp.='0';
			$c++;
		}
		return $temp.$num;

	}


	/*

	restituisce il mese
	*/
	public function getMese($m){

		 $mesi = array(0=>'Gennaio', 1=>'Febbraio', 2=>'Marzo', 3=>'Aprile', 4=>'Maggio', 5=>'Giugno', 6=>'Luglio', 7=>'Agosto',
 8=>'Settembre',
 9=>'Ottobre',10=>'Novembre', 11=>'Dicembre');

		return $mesi[$m];
	}
		public function getMeseS($m){

		 $mesi = array(0=>'Gen', 1=>'Feb', 2=>'Mar', 3=>'Apr', 4=>'Mag', 5=>'Giu', 6=>'Lug', 7=>'Ago',
 8=>'Set',
 9=>'Ott',10=>'Nov', 11=>'Dic');

		return $mesi[$m];
	}
	/*

	metodo che restituisce una stringa
	*/

	public function getStringa($t){
     $l= strlen($t);

	 return substr($t, 0, $l-1);
	}


	/*
	 * metodo che converte un array in un oggetto
	 *
	 */
  public function arrayToObject($array) {
		if (!is_array($array)) {
			return $array;
		}

		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = strtolower(trim($name));
				if (!empty($name)) {

					$object->$name = self::arrayToObject($value);
				}
			}
			return $object;
		}
		else {
			return FALSE;
		}
	}
/*
 * metodo per pulire un nome
 *
 */



public  function pulisciNome($t) {

			   $t=trim($t);
			$t = str_replace(',', '', $t);
			$t = str_replace(' ', '_', $t);
      $t = str_replace('"', '', $t);
		  return $t;

            }


/*
 * metodo per troncare un testo
 *
 */



public  function troncaTesto($testo, $caratteri) {

            if (strlen($testo) <= $caratteri)
            return $testo; $nuovo = wordwrap($testo, $caratteri, "|");
            $nuovotesto=explode("|",$nuovo);
            return $nuovotesto[0]."...";
			}

			public  function troncaTesto2($testo, $caratteri) {
                  $testo=self::sentence_case($testo);
			            if (strlen($testo) <= $caratteri)
			            return $testo; $nuovo = wordwrap($testo, $caratteri, "|");
			            $nuovotesto=explode("|",$nuovo);
			            return $nuovotesto[0]."...";
						}
						function sentence_case($string) {
						    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
						    $new_string = '';
						    foreach ($sentences as $key => $sentence) {
						        $new_string .= ($key & 1) == 0?
						            ucfirst(mb_strtolower(trim($sentence), 'UTF-8')) :
						            $sentence.' ';
						    }
						    return trim($new_string);
						}

/*
 * metodo calcolo fattura
*
*/

public function calcolo($totale){

	 $imponibile=round($totale/1.22, 2);//iva al 21->portare al 22

	$compenso=round($imponibile/1.02, 2);

	$ritenuta=round($compenso*20/100, 2);

	//$res=$totale-$ritenuta;

	return $compenso;

}
public function ritenuta($totale){

	$imponibile=round($totale/1.22, 2);//iva al 21->portare al 22

	$compenso=round($imponibile/1.02, 2);

	$ritenuta=round($compenso*20/100, 2);



	return $ritenuta;

}



public function sanitizeFile($f, $c){

	$path_info = pathinfo($f);
	$este= $path_info['extension'];
	return 'alle_'.$c.'.'.$este;

}

/*
 *
 * metodo che ripulisce un campo
 */
public	function clean($a){


	return utf8_decode(trim(ucfirst(mb_strtolower($a, 'UTF-8'))));

}
public	function maiu($a){


	return mb_strtoupper($a, 'UTF-8');

}
public	function iniziali($a){


	return ucwords(mb_strtolower($a, 'UTF-8'));

}
/*
 *
 * metodo che effettua il decode dei valori di un form passati da js in serialize
 */
public	function decode($a=array()){

	foreach ($a as $key => $value) {
		$a[$key] = utf8_decode( mb_strtolower($value, 'UTF-8'));

	}

	return $a;

}

/*
 *
 * metodo che effettua l'encode dei valori di un form passati da js in serialize
 */
public	function encode($a=array()){

	foreach ($a as $key => $value) {
		$a[$key] = utf8_encode( $value);

	}

	return $a;

}
//FUNZIONI SULLE DATE //////////////////////////




/*

calcolo data scadenza fine mese
*/
public function getSca($d){


	$m=substr($d, 3, 2);
	$a=substr($d, 6, 4);
  $g= cal_days_in_month(CAL_GREGORIAN, $m, $a);
       return mktime(0,0,0, $m, $g, $a);



}

/*

calcolo fine mese
*/
public function end_of_month($date, $days) {
	$date = mktime(0, 0, 0, date('n', $date), date('j', $date) + $days, date('Y', $date));
	$date = mktime(0, 0, 0, date('n', $date) + 1, 0, date('Y', $date));
	return $date;
	}
/*
 * accetta come parametri la data nel formato dd/mm/aaaa
 * restituisce la data nel formato timestamp
 */

public function getData($d){



	$g=substr($d, 0, 2);
	$m=substr($d, 3, 2);
	$a=substr($d, 6, 4);

	$data=mktime(0,0,0, $m, $g, $a);

	return $data;
}
/*
 * accetta come parametri la data nel formato dd/mm/aaaa e ora
 * restituisce la data nel formato timestamp
 mktime(hour,minute,second,month,day,year,is_dst);
 */

public function getDataPre($d, $h, $min){



	$g=substr($d, 0, 2);
	$m=substr($d, 3, 2);
	$a=substr($d, 6, 4);

	$data=mktime($h,$min,0, $m, $g, $a);

	return $data;
}

/*
	 * accetta come parametri la data nel formato timestamp
	 * restituisce la data nel formato dd/mm/yyyy
	 */

	public function getTime($d=null){
		if(is_null($d)) $d=CURRENT_DATE;
		return date('d/m/Y', $d);

	}
	public function getDataxml($d=null){
		if(is_null($d)) $d=CURRENT_DATE;
		return date('Y-m-d', $d);

	}

	public function getDataIta($d=null)
	{
	 if(is_null($d)) $d=CURRENT_DATE;
	 return date('d', $d).' '.self::getMese((int)date('m',$d)-1).' '.date('Y', $d);

	}
	/*
	 * accetta come parametri la data nel formato timestamp
	 * restituisce  mese anno o giorno corrente in base al parametro t
	 j per day
	 n per mese numero senza 0
	 Y anno
	 tabella completa qui http://php.net/manual/it/function.date.php
	 */
	public function getCurr($d=null, $t='Y'){
		if(is_null($d)) $d=CURRENT_DATE;

		return date($t, $d);

	}


	public function getTime2($d=null){
		if(is_null($d)) $d=CURRENT_DATE;
		return date('H:m', $d);

	}


public function datediff($tipo, $partenza, $fine)
{
	switch ($tipo)
	{
		case "A" : $tipo = 365;
		break;
		case "M" : $tipo = (365 / 12);
		break;
		case "S" : $tipo = (365 / 52);
		break;
		case "G" : $tipo = 1;
		break;
	}
	$arr_partenza = explode("/", $partenza);
	$partenza_gg = $arr_partenza[0];
	$partenza_mm = $arr_partenza[1];
	$partenza_aa = $arr_partenza[2];
	$arr_fine = explode("/", $fine);
	$fine_gg = $arr_fine[0];
	$fine_mm = $arr_fine[1];
	$fine_aa = $arr_fine[2];
	$date_diff = mktime(12, 0, 0, $fine_mm, $fine_gg, $fine_aa) - mktime(12, 0, 0, $partenza_mm, $partenza_gg, $partenza_aa);
	$date_diff  =(($date_diff / 60 / 60 / 24) / $tipo);
	return $date_diff;
}

public function form($t){

	//istanzio la tabella
	$db=new DB();

	$row= $db->selectAll($t);


	foreach ($row as $k) {
		foreach ($k as $key=>$val) {

		switch($val){
			case 0://hidden
				echo $c='<p><label>'.$key.'</label><input type="hidden" name="'.$key.'"  value="<?php echo $'.$key.';?>"/></p>';


			break;
			case 1://testo
				echo $c='<p><label>'.$key.'</label><input type="text" name="'.$key.'" value="<?php echo $'.$key.';?>" /></p>';
			break;
			case 2://select
			echo $c='<p><label>'.$key.'</label><select name="'.$key.'"><option value="<?php echo $'.$key.';?>" selected><?php echo $'.$key.';?></option></select> </p>';
			break;
			case 3://textarea
			echo $c='<p><label>'.$key.'</label><textarea name="'.$key.'"><?php echo $'.$key.';?></textarea> </p>';
			break;
			case 4://checkbox
			echo $c='<p><label>'.$key.'</label><input type="checkbox" name="'.$key.'[]" value="" /></p>';
			break;
			case 5://radio
			echo $c='<p><label>'.$key.'</label><input type="radio" name="'.$key.'" value="" /></p>';
			break;
		}
		}
	}

}
public function campi($t){

	//istanzio la tabella
	$db=new DB();

	$row= $db->selectAll($t);

	foreach ($row as $k) {
		foreach ($k as $key=>$val) {

			echo '$'.$key.'=$r->'.$key.';<br>';
		}
	}

}

/*
 * metodo che rinomina il file in upload con un id univoco da tabella
 */
public function renameFile($f){

	$fa=explode('.', $f);

	$est=$fa[count($fa)-1];
	return	DB::add('img_id').'_'.rand(0,999).rand(0,999).'_foto.'.$est;

}
/*
 *
 * metodo per sapere l'estensione di un file
 */
public function getExt($f){

	$fa=explode('.', $f);

	return	strtolower($fa[count($fa)-1]);


}

/*
 * metodo per conoscere l'url dell'applicazione
 *
  *
  *
*/
 public function getPath(){

return $_SERVER['HTTP_HOST'];


}

public function my_htmlentities($var, $qs = ENT_COMPAT, $charset = 'UTF-8')
{
	/*test
	$search = array('ì', 'è', 'é', 'ò', 'à', 'ù');
	$replace = array('&igrave;', '&egrave;', '&eacute;', '&ograve;', '&agrave;', '&ugrave;');

	$var = stripslashes(str_replace($search, $replace, $var));
	$var = htmlentities($var, $qs, $charset, false);
*/
	return  strip_tags($var);
}
public function my_htmlentities2($var, $qs = ENT_COMPAT, $charset = 'UTF-8')
{
	$search = array('ì', 'è', 'é', 'ò', 'à', 'ù');
	$replace = array('i\'', 'e\'', 'e\'', 'o\'', 'a\'', 'u\'');
    $var =stripslashes($var);
	$var = str_replace($search, $replace, $var);
	$var = htmlentities($var, $qs, $charset, false);

	return $var;
}
public function utf8Encode($var)
{

	return utf8_decode(stripslashes($var));

}
public function pulisci($var){


	return   $var;

}

public function pulisciRef($var){

    //$var=utf8_encode($var);
	//return   html_entity_decode(str_replace('&nbsp;', '',  $var), ENT_COMPAT, 'UTF-8');
	return  str_replace('&nbsp;', '',  $var);

}


public function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}


/*
 * metodo che accoda degli array con la funzione array_push restituendo un array associativo
 *
 */
public	function array_push_associative(&$arr) {
	$args = func_get_args();
	@array_unshift($args); // remove &$arr argument
	foreach ($args as $arg) {
		if (is_array($arg)) {
			foreach ($arg as $key => $value) {
				$arr[$key] = $value;
				$ret++;
			}
		}
	}

	return $ret;
}
 public function getSearch($search=null){

				if (is_null ( $search )) {
			$search = '';
		} else {
			$str = '';
			foreach ( $search as $k => $v ) {
				if($k!='req' and $v!='' and $k!='page'){
                 $v=str_replace("\\", "", $v);
								 if (is_array($v))
								 {
									//   echo  $v=http_build_query($v);
                  foreach ( $v as $kar=>$var) {

                    $v=http_build_query(array($k=>array($kar=>$var)));
                   	$str .= '&' .  $v;
									}

								 }
								 else {
									 	$str .= '&' . $k . '=' . $v;
								 }

				}
			}
		}
			return $str;
			}
			 public function getSearch2($search=null){

				if (is_null ( $search )) {
			$search = '';
		} else {
			$str = '';
			foreach ( $search as $k => $v ) {
				if($k!='req' and $v!='' ){
                 $v=str_replace("\\", "", $v);
				$str .= '&' . $k . '=' . $v;
				}
			}
		}
			return $str;
			}

/*
metodo che ritorna la chiave di un campo in array
*/
 public function getKey($val=null){



			foreach ( $val as $k => $v ) {
			if($k!='req' and $v!='' ) return true;

				}



			}


	/*
metodo che intercetta i dati get o post e li memorizza in valori di sessione
*/
 public function getSessione($val=null){



			foreach ( $val as $k => $v ) {
				if($k!='req' and $v!='' ){

			   $_SESSION ['search'][$k]= trim($v);

				}

		}

			}
			/*
metodo che intercetta i dati get o post e li memorizza in valori di sessione
*/
 public function putSessione($val=null){



			foreach ( $val as $k => $v ) {

               	if($k!='req' and $v!=''){
			   $_GET[$k]= trim($v);
				}



				}

			}
	/*
metodo che azzera i valori di sessione
*/
public function delSessione($val=null){



			foreach ( $val as $k => $v ) {
				if($k!='req' and $v!='' and $k!='page'){

			 session_unset( $_SESSION ['search'][$k]);

				}

		}
		session_unset( $_SESSION ['search']);

			}
	/*
metodo che esegue l'escape dei dati
*/
 public function getEscape($val=null){



			foreach ( $val as $k => $v ) {
				if($k!='req' and $v!='' and $k!='page'){

				 $_GET[$k]=DB::escape($v) ;

				}

		}

			}
/*
metodo che intercetta la virgola nei prezzi e la trasforma in $punti
*/

public function decimalComma($val=0){

   return str_replace(',', '.', $val);

}



	/*
metodo che esegue il backup
*/
	public	function backup_tables($host, $user, $pass, $dbname, $tables = '*') {
    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");
		mysqli_query($link,'SET foreign_key_checks = 0');
 //do some stuff here

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, " SHOW FULL TABLES where Table_type='BASE TABLE'");
        while($row = mysqli_fetch_row($result))
        {

            $tables[] = $row[0];
        }
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {

		if($table!='accettazione' and $table!='elencoreferti_v' and $table!='fatture_n' and
		$table!='referti_v' and  $table!='fatturate_v' and  $table!='fatturate2_v'
		and  $table!='fatturazione_v' and  $table!='esami_v' and  $table!='esami2_v' and  $table!='esami3_v'
    and  $table!='esamiclimese_v' and  $table!='esamicli_v' and  $table!='esamitipo_v' and  $table!='refertimancanti_v'
		and $table!='esami_fatturati_v' and  $table!='fatturemesecli_v' and  $table!='fatturecli_v'
		){

        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++)
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
		}
        $return.="\n\n\n";

    }
  		mysqli_query($link,'SET foreign_key_checks = 1');
    //save file
    $fileName = 'backup/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        return $fileName;
        exit;
    }
}
}
