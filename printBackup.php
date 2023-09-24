<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache"); 

include("./autoloader.php");

$db= new DB();
$id=$_GET['id_scheda'];
$anno=$_GET['anno'];

$cl=new Clear();


//stampo le schede
$row = $db->selectAll('schede', array('id'=>$id, 'anno'=>$anno));
if($row>0){
foreach($row as $r){
	$r=$cl->pulisci($r);
	$id_struttura = $r['id_struttura'];
	$id_proprietario = $r['id_proprietario'];
	$id_animale = $r['id_animale'];
	$tipo = $r['tipo'];
	$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
	$num=$r['num'];
	$urgenza = $r['urgente'];
	$margini = $r['margini'];
	$totale=$r['totale'];
    $seconda_refertazione=$r['seconda_refertazione'];
	$punti=  ucfirst(strip_tags($r['punti']));
	$note2 =  ucfirst(strip_tags($r['note']));
	if($punti != '') $punti="<b>Margini:</b>  ".$punti."<br />";
	if($note2 != '') $note2="<b>Note:</b>  ".$note2."<br />";
 $allegati=(int) count($db->selectAll('allegati', array('id_scheda'=>$id)));
 if($allegati>0) $alle="Sono presenti n.$allegati allegati";
	$data = Utility::getTime($r['time']);
	$destinatario = $r['destinatario'];
	if($id_cat==10 or $id_cat==11) $destinatario ='clinica';
    $num_referto=$r['num_referto'];

	$qta=$r['qta'];
}
//verifico se ci sono allegati 




$p= new geo();
$row = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row as $r){

	$nome = ucwords($r['nome']);

	$indirizzo = $r['indirizzo'];
	$email = $r['email'];
	$piva = $r['piva'];
	if(is_numeric($r['comune']))
	$comune =  $p->getCom($r['comune']);
	$idcomune=$r['comune'];
	if(is_numeric($r['provincia']))
	$provincia = $p->getProv($r['provincia']);
	$foto= $r['foto'];
	$referente= $r['referente'];
}

$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));

if(count($row)>0)
foreach($row as $r){

	    $nome_proprietario = Utility::maiu($r['nome_proprietario']);
 		$cognome_proprietario = Utility::maiu($r['cognome_proprietario']);
 		$indirizzo_pro = $r['indirizzo_pro'];
 		$id_prov_pro=$r['provincia_pro'];
 		$id_com_pro=$r['comune_pro'];
 		if(is_numeric($r['provincia_pro']))
 		$provincia_pro = $p->getProv($r['provincia_pro']);
 		if(is_numeric($r['comune_pro']))
 		$comune_pro =  $p->getCom($r['comune_pro']);
 		$cap_pro = $r['cap_pro'];
 		$email_pro = $r['email_pro'];
 		$cod_pro = strtoupper($r['cod_pro']);
		$tel_pro=$r['tel_pro'];
		$dati_prop=$indirizzo_pro.' '.$cap_pro.' '.$comune_pro.' '.$cod_pro.' '.$tel_pro.' '.$email_pro;

}
$prop='';
if($id_cat!=10 and $id_cat!=11) $prop="$nome_proprietario 	$cognome_proprietario";
$row = $db->selectAll('animale', array('id_scheda'=>$id));

$a=new Animale();
if(count($row)>0)
foreach($row as $r){

	$idrazza = $r['razza'];
 		$razza=($a->getAnimal($idrazza, 'razza'));
 		$idspecie = $r['specie'];
 		$specie=($a->getAnimal($idspecie, 'specie'));
 		$idorgano = $r['organo'];
 		$organo=($a->getAnimal($idorgano, 'organo'));
	$sesso = ucfirst($r['sesso']);
	$integrita = ucfirst($r['integrita']);
	if($sesso=='Femmina') {
		if($integrita=='Intero') $integrita='Intera';
		if($integrita=='Castrato') $integrita='Sterilizzata';
	}
	$anamnesi = ucfirst(strip_tags($r['anamnesi']));
	//$anamnesi= str_replace(array("\n","\r"), "", $anamnesi);
	$eta=$r['eta'];
	$nome_animale='';
	if($r['nome']!=''){ $nome_animale='<b>Nome animale: </b>'.ucfirst($r['nome']).' ';}
	else{
		$nome_animale='<b>Nome animale: </b> non segnalato ';
	}
}


$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
//estrapolo il titolo -categoria + nome esame
$tipo_s = $nome_cat;
if($tipo!=88){
$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=>$tipo));
$tipo_s .= ' - '.$nome_esame;
}



if($urgenza =='s') $tipo_s.='<br/> URGENTE ';


if($seconda_refertazione =='s') $tipo_s.='<br/> SECONDA OPINIONE';

$st_prop="<tr>
<td width=\"75\" style='text-align:left'>
<b>Proprietario</b>  
</td>
<td width=\"425\" style='text-align:left'>
$prop
</td>
</tr>";
if($id_cat==10 or ($tipo>38 and  $tipo <42)) $st_prop='';
$scheda ="
<body style='text-align:center'>
<table width=\"500\" style='border:none'>
<tr><td width=\"500\" style='text-align:center'>
<img src='./img/logo-bianco.jpg'  height='auto' width='40px' />
</td>
</tr>
<tr>
<td width=\"500\">
<h4 style='text-align:center'>
Ablab 
<br />  
Modulo di richiesta esame</h4></td>
</tr>
</table>
<table width=\"500\" style='border:1px;padding:2px'>
<tr>
<td width=\"500\" style='text-align:center'>
<h4>Scheda  $tipo_s <br/>  $num / $anno <br/></h4>  
</td>
</tr>
</table>
<br />
<table width=\"500\"  style='padding:2px'>
<tr>
<td width=\"500\" style='text-align:right'>
<b>Data</b>    $data 
</td>    
</tr>
<tr>
<td width=\"75\" style='text-align:left'>
<b>Veterinario</b>      
</td>
<td width=\"425\" style='text-align:left'>
$nome   
</td>
</tr>
<tr>
<td>
</td>
</tr>
$st_prop

</table>
<br/>
";
if($anamnesi!='') $ana="<b>Quadro sintomatologico: </b>    $anamnesi"; 

//animale
if($id_cat!=10 and $id_cat !=8 and( $tipo!=39 and  $tipo !=40 and $tipo !=41 )){
$scheda .="


<table  width=\"500\" style='padding:2px;' >
<tr>
<td width=\"250\" style='text-align:left'>
<b>Animale</b>   $specie  

</td>
<td width=\"250\">
$razza

</td>

  </tr>
  <tr>
<td>
</td>
</tr>
<tr>
<td width=\"500\">
$nome_animale

</td>
</tr>
<tr>
<td>
</td>
</tr>
<tr>
<td width=\"250\">                   
 <b>Età:</b>     $eta      

</td>
<td width=\"180\">
<b>Sesso: </b>    $sesso    $integrita  
            </td>

 </tr>
 <tr>
<td>
</td>
</tr>
<tr>
<td width=\"500\">                
<b>Campione:</b> $organo <br/><br/>
$ana
<br/> 
</td>
</tr>

</table>


";

}

if($num_referto!=''){
	
if($tipo>38 and  $tipo <42) $st_note=" $note";
$scheda .="


<table  width=\"500\" style='padding:2px;' >
<tr>
<td width=\"500\">
<b>Referto</b> $num_referto

</td>
 </tr>
<tr>
<td width=\"500\">
 $st_note

</td>
 </tr>
</table>


";

}
if($qta!=''){
	
	if($tipo==88) $nome_esame='Richiesta copia vetrini';
$scheda .="


<table  width=\"500\" style='padding:2px;' >
<tr>
<td width=\"500\" style='text-align:left'>
<b>Tipo</b>   $nome_esame

</td>
 </tr>
  <tr>
<td width=\"200\">


</td>

 </tr>
 <tr>
<td width=\"500\">
<b>QTA richiesta</b> $qta

</td>

 </tr>

</table>


";

}








$scheda .="
<br />
<table width=\"500\" style='border:none;padding:5px;' >
<tr>
<td>
<br/> 


	$note2<br/> 
	
	<br/>
	 $alle
	 <br/>
</td>
</tr>

</table>

</body>
";

}



if($destinatario=='proprietario'){
	
	
	$scheda.="<strong>Fattura a ".$destinatario."</strong>
	<br>Costo dell'esame: $totale Euro (IVA compresa)<br>";
	
	$scheda.=
	$dati_prop;
	
}
require_once('./tcpdf/config/lang/it.php');
require_once('./tcpdf/tcpdf.php');




$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
// set font

$pdf->SetFont('helvetica', '', 12);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("ablab");
$pdf->SetTitle("SCHEDA Ablab");


$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



//initialize document
//$pdf->AliasNbPages();

// add a page
$pdf->AddPage();

$pdf->writeHTML($scheda, true, 0, true, 0);


if($destinatario=='proprietario'){
	$pdf->SetFont('helvetica', '', 7);

	include('print_privacy.php');
		$pdf->AddPage();
$pdf->writeHTML($scheda, true, 0, true, 0);
}

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output("scheda.pdf", "I", "I");

//============================================================+
// END OF FILE                                                 
//============================================================+
?>