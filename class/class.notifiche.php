<?php
/*
 * classe per gestire le notifiche di lettura dei post sul forum
 * @author npasa
 */

Class Notifiche extends DB
{

/*
* metodo che ritorna il numero di notifiche solo per utente specifico
* 
*/	
public  function getNonLetteS($id, $contesto )
{

$num=0;

foreach(parent::selectAll('notifiche',array('contesto'=>$contesto, 'id_struttura'=>$id), '  id desc ') as $r){
	
	$utenti=explode(',',$r['utenti']);

if(!(in_array($id, $utenti))) $num++;
}

return 	$num;
}

/*
* metodo che ritorna il numero di notifiche per utente di discussioni non lette
* 
*/	
public  function getNonLette($id, $contesto )
{

$num=0;

foreach(parent::selectAll('notifiche',array('contesto'=>$contesto), '  id desc ') as $r){
	
	$utenti=explode(',',$r['utenti']);

if(!(in_array($id, $utenti))) $num++;
}

return 	$num;
}


public  function getNonLetta($id,$id_post , $contesto )
{

$flag=false;

foreach(parent::selectAll('notifiche',array('id_post'=>$id_post, 'contesto'=>$contesto), '  id desc ') as $r){
	
	$utenti=explode(',',$r['utenti']);

if(!(in_array($id, $utenti))) $flag=true;
}

return 	$flag;
}
/*
 * metodo che verifica se quell'utente ha letto la specifica discussione e ritorna un array di id 
 */
public  function getLette($id,$contesto, $id_post, $tipo)
{

$arr=array();

	foreach(parent::selectAll('notifiche', array('contesto'=>$contesto, 'id_post'=>$id_post, 'tipo'=>$tipo   ), '  id desc ') as $r){
		$utenti=explode(',',$r['utenti']);
	if(!(in_array($id, $utenti))) array_push($arr, array($contesto, $r['id_post'], $r['tipo']));
	}

	return 	$arr;
}

/*
 * metodo che verifica se quell'utente ha letto la specifica discussione 
 */
public  function getLetta($id, $id_post, $contesto)
{

	$flag=false;
    $row=parent::selectAll('notifiche',array('contesto'=>$contesto, 'id_post'=>$id_post));
	
	foreach($row as $r){

		if( (!in_array($id, (explode(',',$r['utenti']))))) {
			if($r['utenti'] !=''){
			$utenti=$r['utenti'].','.$id;
			}
			else
			{
				
				
				$utenti=$id;
			
			}
			//faccio update
			parent::update('notifiche', array('utenti'=>$utenti), $r['id']);
			$flag=true;
		}
	}

	return 	$flag;
}


}	