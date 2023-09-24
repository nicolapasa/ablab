<?php
session_start();
include("./autoloader.php");
//id_post è id fatturazione


$db= new DB();
$id=$_GET['id'];
$tipo=$_GET['t'];


if($tipo=="f"){

  $flag_f=$db->getCampo('invio', 'fattura', array('id_fat'=>$id));
  if($flag_f!='' and ($flag_f==0 or $flag_f==1))
  {

   $id_invio=$db->getCampo('invio', 'id', array('id_fat'=>$id));
   $db->update('invio', array('fattura' =>1  ), $id_invio);

  }
  else{

     $db->add('invio', array('fattura' =>1, 'id_fat'=>$id  ));
  }


}
if($tipo=="s"){

  $flag_s=$db->getCampo('invio', 'sollecito', array('id_fat'=>$id));
  if($flag_s!='' and ($flag_s==0 or $flag_s==1))
  {

   $id_invio=$db->getCampo('invio', 'id', array('id_fat'=>$id));
   $db->update('invio', array('sollecito' =>1, 'data'=>time()  ), $id_invio);

  }
  else{

     $db->add('invio', array('sollecito' =>1, 'data'=>time(),'id_fat'=>$id  ));
  }


}



$p= new geo();

$row = $db->selectAll('fatturate_v', array('id'=>$id));

foreach($row as $r){

$num=$r['num'];
$id_cliente= $r['id_cliente'];
$importoT=$r['importo'];
$importo = number_format($r['importo'] , 2, ',', '.');
$dest=$r['dest'];
$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];
//$nominativo=Utility::pulisciNome(Utility::iniziali($r['nominativo']));
$pdf_name=$db->getCampo('fatture', 'nome_file', array('id'=>$id));
//$pdf_name=$anno.'-'.$num.'-'.$nominativo.'.pdf';
//$pdf_name2=$anno.'-'.$num.'-'.$nominativo.'-allegato.pdf';
$pdf_name2=$db->getCampo('fatture', 'nome_alle', array('id'=>$id));
}
if($pagata!='s'){
if($tipo=='f'){



$data_invio==time();
$oggetto='Fattura  AbLab ';
//$url1=URL_GEN."print_fat.php?id=".$id;
$pdf=__ROOT__.'/fatture/'.$pdf_name;
//$pdf_name=str_replace('.pdf', '', $pdf_name);
$pdf2=__ROOT__.'/fatture/'.$pdf_name2;
//$pdf_name2=str_replace('.pdf', '', $pdf_name2);
//$url2=URL_GEN."print_alle.php?id=".$id;

$fat=$db->sqlquery("select * from fatture where id_cliente='$id_cliente' and
id < '$id' and pagata !='s' order by num desc ");
if(count($fat)>0) {

//devo vedere se ci sono altre fatture insolute
	$ins.='<br> La preghiamo inoltre di verificare il pagamento delle seguenti fatture: <br> ';
foreach($fat as $f){

	$importoP=$importoP+$f['importo'];

    $ins.=' n° <b>'.$f['num'].'</b> del '.Utility::getTime($f['data']).' di importo pari a euro '.number_format($f['importo'] , 2, ',', '.').'  <br> ';




}
$importoP=number_format($importoP , 2, ',', '.');
$ins.='
per un importo complessivo pari a Euro '.$importoP.'.
<br>
Si chiede gentilmente riscontro in caso di pagamento già avvenuto o non ancora contabilizzato.
<br><br> ';
}

    include('head_template.php');
	$body=$p;

//se con riba 



if($dest=='c')
{
//get se riba  
$mod_pag=$db->getCampo('admin', 'mod_pag', array('id'=>$db->getCampo('fatturate_v', 'id_cliente', array('id'=>$id))));
if($mod_pag=='bonifico'){


  $tipo_pagamento='Per procedere al pagamento tramite bonifico bancario:<br><br>
  IBAN:
  <b>IT49T0623049841000043964722</b>
  <br><br>';
}
else{
  $tipo_pagamento='<br>La fattura è stata caricata come RIBA sul vostro conto corrente, con scadenza fine mese.<br><br>';

}



  include('email_fatture_tmpl.php');
}
else
{
    include('email_fatture_prop_tmpl.php');
}

	$body.=$tpf;


	$body.='
</body>
</html>';
Utility::inviaMailFatt(MAIL_AMMINISTRAZIONE, $oggetto, $body, $pdf, $pdf2, $pdf_name, $pdf_name2);
}
if($tipo=='s'){ //contare i solleciti

$oggetto='Sollecito Fattura  AbLab ';
$data_sollecito=time();
   include('head_template.php');
	$body=$p;

 $mod_pag=$db->getCampo('admin', 'mod_pag', array('id'=>$id_cliente));

$fat=$db->sqlquery("select * from fatture where id_cliente='$id_cliente' and
id < '$id' and pagata !='s' order by num desc ");
if(count($fat)>0) {
//devo vedere se ci sono altre fatture insolute
	$ins=' n° '.$num.' del '.$data.' <br> ';
foreach($fat as $f){

	$importoT=$importoT+$f['importo'];
	$ins.=' n° '.$f['num'].' del '.Utility::getTime($f['data']).' <br> ';


}
$importoT=number_format($importoT , 2, ',', '.');

if($dest=='c'){

  if($mod_pag=='bonifico'){
    include('email_solleciti_tmpl.php');
  }
  else{
    include('email_solleciti_riba_tmpl.php');
  }
  
 
}
else{
    include('email_solleciti_pro_tmpl.php');
}

}

else{
  if($dest=='c'){

   
    if($mod_pag=='bonifico'){
      include('email_sollecito_tmpl.php');
    }
    else{
      include('email_sollecito_riba_tmpl.php');
    }
  
  }
  else{
      include('email_sollecito_pro_tmpl.php');
  }



}
	$body.=$tso;


	$body.='
</body>
</html>';
Utility::inviaMail(MAIL_AMMINISTRAZIONE, $oggetto, $body);

}
if($dest=='c'){

//se email_fatt vuota allora uso la mail di refertazione
$e_fatt=$db->getCampo('admin', 'email_fatt', array('id'=>$id_cliente));
if($e_fatt!=''){
 $email=array_unique(explode(';',$e_fatt));
}
else{
	 $email=array_unique(explode(';',$db->getCampo('admin', 'email', array('id'=>$id_cliente))));

}

foreach($email as $e){


//Utility::inviaMail($e, $oggetto, $body, $pdf, $pdf2);
Utility::inviaMailFatt($e, $oggetto, $body, $pdf, $pdf2, $pdf_name, $pdf_name2);

$cont++;

}
$email='';

}
else{
$email=$db->getCampo('proprietari', 'email_pro', array('id'=>$id_cliente));
//Utility::inviaMail($e, $oggetto, $body, $pdf);
Utility::inviaMailFatt($e, $oggetto, $body, $pdf, null, $pdf_name, null);
}
//data invio
//data ultimo sollecito

$db->update('fatture', array('inviata'=>'s', 'data_invio'=>$data_invio, 'data_solle'=>$data_sollecito), $id);



}
header("Location: ./index.php?req=fatture");
