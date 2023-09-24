<?php
/*
 * class per le schede ablab
 * @author npasa
 */

Class Scheda extends Auth
{






/*
* metodo che ritorna l'id
*
*/
public  function getIdNext()
{
//devo incrementare una tabella e utilizzare quell'id
//anno corrente
$num=0;
$u=$this->db->selectAll('num_id',array('anno'=>ANNO_CORE), '  id desc ',' limit 1 ');
if(count($u)>0){
foreach($u as $r){

$num = $r['num'];
}
}
$num++;
$this->add('num_id', array('num'=>$num, 'anno'=>ANNO_CORE));
return 	$num;
}



public function delete_scheda($id){


	$u=parent::selectAll('schede', array('id'=>$id), ' id desc ');
	foreach($u as $r){


		$id_animale=$r['id_animale'];
		$tipo=$r['tipo'];
		$arrivato=$r['arrivato'];

		parent::delete('schede', $id);
		parent::delete('animale', $id_animale);
		if($arrivato=='s'){
			$id_ref=parent::getCampo('referti', 'id', array('id_scheda'=>$id));
			parent::deleteP('referti', array('id_scheda'=>$id));
			parent::deleteP('referti_data', array('id_tref'=>$id_ref));
		}


	}

}

}
