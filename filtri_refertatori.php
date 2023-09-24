<?php
if($_GET['anno']!=''){
    $anno_core=$_GET['anno'];
    Utility::array_push_associative($search, array('anno'=>$anno_core));
}
else
{
    $anno_core=ANNO_CORE;
}
//parte refertatori 
$tab='refertimancanti_v';
if($_GET['id_specie']!='' or $_GET['id_razza']!='' or $_GET['animale'] )    $tab='elencoreferti_v';


$sql="select * from ".$tab."
where id in (
select id_referto from 
referti_assegnati 
where  id_refertatore='$id_loggata' )";

if($_GET['id_specie']!=''){

	$id_specie=$_GET['id_specie'];
	 $sql.=" and specie = '$id_specie' ";
	 Utility::array_push_associative($search, array('id_specie'=>$_GET['id_specie']));
}
if($_GET['razza']!=''){

 $razza=$_GET['razza'];
  $sql.=" and razza = '$razza' ";
  Utility::array_push_associative($search, array('razza'=>$_GET['razza']));
}


 if($_GET['num']!=''){

	$num=$_GET['num'];
	 $sql.=" and num = '$num' ";
	 Utility::array_push_associative($search, array('num'=>$_GET['num']));
}
 if($_GET['stato']!=''){

	$stato=$_GET['stato'];
	 $sql.=" and stato = '$stato' ";
	 Utility::array_push_associative($search, array('stato'=>$_GET['stato']));
}
 if($_GET['id_cat']!=''){

	$id_cat=$_GET['id_cat'];
	 $sql.=" and id_cat = '$id_cat' ";
	 Utility::array_push_associative($search, array('id_cat'=>$_GET['id_cat']));
}
if($_GET['id_esa']!=''){

 $id_esa=$_GET['id_esa'];
  $sql.=" and tipo = '$id_esa' ";
  Utility::array_push_associative($search, array('id_esa'=>$_GET['id_esa']));
}
 if($_GET['dataArrivoDa']!=''){

	$dataArrivoDa=Utility::getData($_GET['dataArrivoDa']);
	 $sql.=" and timeArr >= '$dataArrivoDa' ";
	 Utility::array_push_associative($search, array('dataArrivoDa'=>$_GET['dataArrivoDa']));
}
 if($_GET['dataArrivoA']!=''){

	$dataArrivoA=Utility::getData($_GET['dataArrivoA']);
	 $sql.=" and timeArr <= '$dataArrivoA' ";
	 Utility::array_push_associative($search, array('dataArrivoA'=>$_GET['dataArrivoA']));
}
  if($_GET['id_referto_da']!=''){

	$id_referto_da=$_GET['id_referto_da'];
	 $sql.=" and id_referto >= '$id_referto_da' ";
	 Utility::array_push_associative($search, array('id_referto_da'=>$_GET['id_referto_da']));
}
  if($_GET['id_referto_a']!=''){

	$id_referto_a=$_GET['id_referto_a'];
	 $sql.=" and id_referto <= '$id_referto_a' ";
	 Utility::array_push_associative($search, array('id_referto_a'=>$_GET['id_referto_a']));
}

if($_GET['urgente']!=''){

	$urgente=$_GET['urgente'];
	 $sql.=" and urgente = 's' ";
	 Utility::array_push_associative($search, array('urgente'=>$_GET['urgente']));
}

if($_GET['animale']!=''){

	$animale=addslashes($_GET['animale']);
	 $sql.=" and LOWER(animale) like LOWER('%$animale%') ";
	 Utility::array_push_associative($search, array('animale'=>$_GET['animale']));
}



 if($_GET['proprietario']!=''){

	$proprietario=addslashes($_GET['proprietario']);
	 $sql.=" and LOWER(cognome_proprietario) like LOWER('%$proprietario%') ";
	 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}

 if( trim($_GET['testo']!='') and strlen(trim($_GET['testo'])) >0 ){


/*echo strlen(trim($_GET['testo']));
echo ctype_space($_GET['testo']);*/
	$testo=addslashes($_GET['testo']);
	 $tipo_t=$_GET['tipo_t'];
//echo urldecode($tipo_t);
 $cont=	count($tipo_t);

if($cont>0)	$sql.=" and (";

$c=0;
	foreach($tipo_t as $k){

		$c++;
		if($k=='all')
		{
			$sql.=" esito_esame like '%$testo%' or
			esito_esame2 like '%$testo%'
			or commento like '%$testo%' or commento2 like '%$testo%' or
            descr_macro like '%$testo%'	or 	descr_micro like '%$testo%'	or
			diagn_morf like '%$testo%'
			";
		}
		else if($k=='esito_esame'){
		 $sql.=" esito_esame like '%$testo%' or
			esito_esame2 like '%$testo%'   ";

		}else if($k=='commento'){

			$sql.=" commento like '%$testo%' or commento2 like '%$testo%'  ";

		}else{
				 $sql.=" $k like '%$testo%'  ";
		}
		 if($c<$cont)  $sql.=" or  ";

	}

	// $sql.=" and  like LOWER('%$testo%') ";
if($cont>0)		 $sql.=" )  ";
  // echo serialize($tipo_t);
	  Utility::array_push_associative($search, array('tipo_t'=>$tipo_t));
	 Utility::array_push_associative($search, array('testo'=>$testo));
}
if ($_GET['allegati']!='' ){

	 $sql.=" and allegati > 0 ";

	Utility::array_push_associative($search, array('allegati'=>$_GET['allegati']));

}
if ($_GET['ord']!='' ){

	 $ord="  time desc,  ";

	Utility::array_push_associative($search, array('ord'=>$_GET['ord']));

}
  if($_GET['id_referto']!=''){

	$id_referto=$_GET['id_referto'];
	 $sql.=" and id_referto = '$id_referto' ";
	 Utility::array_push_associative($search, array('id_referto'=>$_GET['id_referto']));
}
//perpage
if ($_GET['perpage']!='' ){

	 $perpage=$_GET['perpage'];

	Utility::array_push_associative($search, array('perpage'=>$_GET['perpage']));

}

include('search_ref.php');


?>