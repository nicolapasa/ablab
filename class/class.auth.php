<?php
/*
 * class per autenticare l'utente
 * @author npasa
 */

Class Auth extends DB
{

private $us;
public $db; //istanza del db


public function __construct(){

	$this->db=new DB();
}
	/**
	 * Metodo che verifica le credenziali dell'utente
	 *
	 */
	public function login()
	{
	$aut=false;
	if (isset($_COOKIE['user'])){
	$u=$this->db->selectAll('admin', array('username'=>$_COOKIE['user'], 'attivo'=>'v'));

	if(count($u)>0)
	{
	 $this->us =$_COOKIE['user'];
	 $aut=true;
	}
	}

	 return $aut;
	}

	/*
	* Metodo che verifica la password
	*/
	public function aut($u, $p){
	$u=$this->db->selectAll('admin', array('username'=>$u, 'password'=>$p, 'attivo'=>'v'));

	if(count($u)>0)
	{
	return true;
	}
	}

	/**
	 * Metodo che rimuove i dati di autenticazione
	 *
	 */
	public function logout()
	{

	setcookie('user','','0','/');

	}

  /*

metodo che verifica esistenza nel database di una email

  */
  public function check_email($e)
  {

    $q="select * from admin where email like '%$e%' ";

    $row=$this->db->sqlquery($q);


  	if(count($row)>0)
  	{

       return $row;

  	}

  }

     /**
	 *
	 * Metodo per criptare la password con md5
	 * @param unknown_type $s
	 */
	public function hash($s=null)
	{
		return md5($s);
	}

/*
 *
 * metodo per generare una username, controlla anche che non sia già presente nel db
 *
 */
public function genUser()
{
	$username='utente';
	$username.=rand(0,34000);
//eseguo la fetch della tabella utenti

	$utenti= $this->db->selectAll('admin');

	while (in_array($username, $utenti))  {

	$username='utente';
	$username.=rand(0,34000);

	}

	return $username;

}
/*
 *
* metodo che controlla se esiste gi� una username restituisce un boolean
*
*/
public function checkUser($u)
{

	//eseguo la fetch della tabella utenti

	$utenti= $this->db->selectAll('admin', array('username'=>$u));

	$check='true';
	if(count($utenti)>0) $check='false';


	return $check;

}
/*
 *
 * metodo che controlla se esiste gi� una username restituisce un boolean ma passa
 * se l'id dell'user già inserito
 *
 */
public function checkUserAd($u, $id)
{

	//eseguo la fetch della tabella utenti

	$utenti= $this->db->selectAll('admin', array('username'=>$u));
    $id_admin=$this->db->getCampo('admin', 'id',array('username'=>$u) );
	$check='true';
	if(count($utenti)>0 and $id != $id_admin) $check='false';


	return $check;

}
/*
 *
 * metodo per generare una password
 *
 */
public  function genPass()
{
$len_pass= 6;
$pass_generata='';
for ($i=0; $i<6; $i++){

	$pass_generata = $pass_generata . chr(rand(97,122));
}
return 	$pass_generata;
}

/*
* metodo che ritorna il livello di autorizzazione
*
*/
public  function livello()
{

$u=$this->db->selectAll('admin', array('username'=>$this->us));
foreach($u as $r){

$author = $r['livello'];
}
return 	$author;
}
/*
 *
 *
 * metodo che reindirizza in caso di accesso violato
 */
public function autoriz(){

	if($this->livello()!='administrator') header("Location: index.php?req=404");

}

/*
* metodo che ritorna l'id
*
*/
public  function getNumFatt()
{
//devo incrementare una tabella e utilizzare quell'id
//anno corrente
$num=0;
$u=$this->db->selectAll('num_fatt',array('anno'=>ANNO_CORE), '  id desc ',' limit 1 ');
if(count($u)>0){
foreach($u as $r){

$num = $r['num'];
}
}
$num++;
$this->add('num_fatt', array('num'=>$num, 'anno'=>ANNO_CORE));
return 	$num;
}


/*
* metodo che ritorna l'id
*
*/
public  function getId()
{

$u=$this->db->selectAll('admin', array('username'=>$this->us));
foreach($u as $r){

$id = $r['id'];
}
return 	$id;
}

public function checkAlreadySend($e, $id_news) {
$check=false;
	$u=$this->db->selectAll('error', array('info'=>$e, 'tipo'=>$id_news));

if (count($u)>0) $check=true;
return $check;
}

}
