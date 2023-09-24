<?php
/*
 * class per autenticare l'utente
 * @author npasa
 */

Class Admin extends DB
{


private $db; //istanza del db

   
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
	$u=$this->db->selectAll('user', array('username'=>$_COOKIE['user']));
	
	if(count($u)>0)
	{
	 $aut=true;
	}
	}
	

	 return $aut;
	}
	
	/**
	 * Metodo che rimuove i dati di autenticazione
	 *
	 */
	public function logout()
	{
  
	setcookie('username','','0','/');
	
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
	
	$utenti= $this->db->selectAll('user');

	while (in_array($username, $utenti))  {
		
	$username='utente';	
	$username.=rand(0,34000);	
		
	}
	
	return $username;
	
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
 * 
 * fetch di una tabella parametrizzabile con like
 * 
 */
public function selectAll($table=null, $param=null, $order=null, $confronto=null)	
{
if 	(is_null($confronto)) $confronto='eq'; //altrimenti passo like
if (is_null($param)) $where='';	
else {
$i=count($param);
$i--;
$c=0;
$where=' where ';	
	foreach($param as $key=>$val){
		
	if($confronto == 'like'){
		($c == $i)?	$where.= $key. " like  '%" . $val ."%'" : $where.= $key. " like  '%" . $val ."%' and ";
	}	else 
	{	
		
	($c == $i)?	$where.= $key. " =  '" . $val ."'" : $where.= $key. " =  '" . $val ."' and ";
	}
	$c++;	
	}
}
if (is_null($order)) $order='';	
$q='select * from ' .$table. $where . $order;
$result = mysql_query($q);
while($row= mysql_fetch_array($result, MYSQL_ASSOC)) {
	
$ar[]=$row;	
}
return $ar;
}



/*
 *
* metodo che cancella una clinica e tutti i suoi dati
*/
public function delete($id_struttura){

	parent::delete('admin', $id_struttura);
	$u=parent::selectAll('schede', array('id_struttura'=>$id_struttura), ' order by id desc ');
	foreach($u as $r){

		$id = $r['id'];
		$id_animale=$r['id_animale'];
		$tipo=$r['tipo'];
		$t=substr($tipo, 0, 1);
		
			parent::delete('schede', $id);
			parent::delete('animale', $id_animale);
			Disegno::delete('disegno', $id);
			Disegno::delete('scheda_'.$t, $id);
	
	}

}
}	