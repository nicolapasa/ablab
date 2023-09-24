<?php
include("./autoloader.php");

include("./dati_ablab.php");



$db= new DB();
$id=$_GET['id'];
$tipo=$_GET['tipo'];

$cl=new Clear();
$p= new geo();

$row = $db->selectAll('fatture', array('id'=>$id));

foreach($row as $r){

$numFatt=$r['num'];
$id_cliente= $r['id_cliente'];
$importo = $r['importo'];
$imponibile = $r['imponibile'];
$dest=$r['dest'];
$data = Utility::getTime($r['data']);
$data_fatt=  Utility::getDataxml($r['data']);
$datarif=$data_fatt;
$datasca=Utility::getDataxml(Utility::getSca($data));
$anno=$r['anno'];
$pagata=$r['pagata'];
$esami=explode('-', $r['esami']);
$spe_tra=$r['spe_tra'];
$sconto=$r['sconto'];
$iva_tot=$r['iva'];


if($dest!='p'){
	//dati clinica
$id_struttura=$id_cliente;

	$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){
	//$nome = ucwords($r2['nome']);
	$nome = str_replace('&', '&amp;', utf8_decode($r2['nome']));
	//problema caratteri
	$rag_soc=$nome;
	$indirizzo = utf8_decode($r2['indirizzo']);

	$utenza_estera=$r2['utenza_estera'];
	$email = $r2['email'];
	$piva = trim($r2['piva']);
	$cod=strtoupper(trim($r2['cod']));
	//controllo
	if(strlen($cod) !=7) $cod='0000000';
	$pec=trim($r2['pec']);
	$cf=strtoupper(trim($r2['cf']));
	$comune =  utf8_decode($r2['comune']);
	$idcomune=$r2['comune'];
	if($utenza_estera!='s'){
		$prov = utf8_decode($db->getCampo('province', 'siglaprovincia', array('nomeprovincia'=>addslashes($r2['provincia']))));

	}
	else{
		$prov 	=$r2['provincia'];
	}
	$cap=$r2['cap'];
	$mod_pag=$r2['mod_pag'];
	$nazione=$r2['nazione'];
	$nazione_sigla=$db->getCampo('nazioni', 'sigla', array('nome'=>$nazione));

}
}
elseif($dest=='p'){
	//dati propr
	$row2 = $db->selectAll('proprietari', array('id'=>$id_cliente));

foreach($row2 as $r2){
	$email=$r2['email_pro'];
	$nome = utf8_decode($r2['nome_proprietario']);
	$cognome = utf8_decode($r2['cognome_proprietario']);
	$cf=strtoupper(trim($r2['cod_pro']));
    $indirizzo=utf8_decode($r2['indirizzo_pro']);
	$pec=$r2['pec_pro'];
	$prov = utf8_decode($db->getCampo('province', 'siglaprovincia', array('id'=>$r2['provincia_pro'])));
    $cap=$r2['cap_pro'];
	$comune =  utf8_decode($p->getCom($r2['comune_pro']));
	$nazione_sigla='IT';
}
}



}

 		 //MP05 bonifico
							 //MP12 riba
			//YYYY-MM-DD
//calcolo data scadenza
//$data_fatt=  Utility::getDataxml($r['data']);


			if( $mod_pag =='riba'){

				$mod='Pagamento: RIBA FINE MESE';
                $modalpag='MP12';
			}
			else{

				$mod='Pagamento: Rimessa diretta/Bonifico Bancario FINE MESE';
				$modalpag='MP05';
			}



//gestione degli zero
if (! preg_match('/^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/',$pec) )
$pec='';

//controllo pec

//
$num_file=Utility::mettiZero(5, $numFatt);
$nome_file='./XML/'.$anno.'/SM03473_'.$num_file.'.xml';

if( !file_exists('./XML/'.$anno)) mkdir('./XML/'.$anno, 0777);
if(file_exists($nome_file)) unlink($nome_file);

$myXML = fopen($nome_file, "w") or die("Unable to open file!");


//controllo cod

//$cod=Utility::checkCod($cod);


$xml =  "<?xml version=\"1.0\" encoding=\"windows-1252\"?>\r\n";
$xml.="<?xml-stylesheet type=\"text/xsl\" href=\"fatturapa_v1.2.xsl\"?>\r\n";

$xml.="<p:FatturaElettronica versione=\"FPR12\"
xmlns:ds=\"http://www.w3.org/2000/09/xmldsig#\"
xmlns:p=\"http://ivaservizi.agenziaentrate.gov.it/docs/xsd/fatture/v1.2\"
xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\r\n";

$xml.='<FatturaElettronicaHeader>
<DatiTrasmissione>
<IdTrasmittente>
<IdPaese>SM</IdPaese>
<IdCodice>03473</IdCodice>
</IdTrasmittente>';
$xml.='<ProgressivoInvio>'.$numFatt.'</ProgressivoInvio>';
$xml.='<FormatoTrasmissione>FPR12</FormatoTrasmissione>'; //'fpa12 se PA


  if($dest=='p'){
$xml.='<CodiceDestinatario>0000000</CodiceDestinatario>';

  }else if($cod!='') {


$xml.='<CodiceDestinatario>'.$cod.'</CodiceDestinatario>';

  }
  else{
	$xml.='<CodiceDestinatario>0000000</CodiceDestinatario>';

  }
  if($pec!=''){
 $xml.='<PECDestinatario>'.$pec.'</PECDestinatario>';
  }
 $xml.='</DatiTrasmissione>';
       //parte ablab
	 $xml.='<CedentePrestatore>
              <DatiAnagrafici>
                 <IdFiscaleIVA>
            <IdPaese>IT</IdPaese>
          <IdCodice>'.$piva_soc.'</IdCodice>
            </IdFiscaleIVA>
			<CodiceFiscale>'.$cf_soc.'</CodiceFiscale>
             <Anagrafica>
              <Denominazione>'.$rag_socAblab.'</Denominazione>
            </Anagrafica>
              <RegimeFiscale>'.$regimeFiscale.'</RegimeFiscale>
		       </DatiAnagrafici>
              <Sede>
			  <Indirizzo>
			  '.$ind_soc.'
			  </Indirizzo>
			  <CAP>'.$cap_soc.'</CAP>
                <Comune>'.$comune_soc.'</Comune>
                <Provincia>'.$prov_soc.'</Provincia>
                <Nazione>IT</Nazione>
				</Sede>
           <IscrizioneREA>
              <Ufficio>'.$uff.'</Ufficio>
                <NumeroREA>'.$numRea.'</NumeroREA>
                   <StatoLiquidazione>'.$stato_liqui.'</StatoLiquidazione>
                   </IscrizioneREA>
            <Contatti>
                <Telefono>'.$tel_soc.'</Telefono>
				<Email>'.$email_soc.'</Email>
                  </Contatti>
             </CedentePrestatore>';
		//end dati ablab
//parte dati cliente
    $xml .='<CessionarioCommittente>
            <DatiAnagrafici>';

			if($dest!='p'){
         $xml.='<IdFiscaleIVA>
                    <IdPaese>IT</IdPaese>
                      <IdCodice>'.$piva.'</IdCodice>
                </IdFiscaleIVA>';

			}
              else{
                    $xml.='<CodiceFiscale>'.$cf.'</CodiceFiscale>';
			  }

             $xml.='<Anagrafica>';

			 if($dest!='p'){


				 $xml.='<Denominazione>'.$rag_soc.'</Denominazione>';
			 }
             else{

                 $xml.='<Nome>'.$nome.'</Nome>
                      <Cognome>'.$cognome.'</Cognome>';

			 }

            $xml.='</Anagrafica>
			</DatiAnagrafici>
			<Sede>
			 <Indirizzo>'.$indirizzo.'</Indirizzo>
			 <CAP>'.$cap.'</CAP>
			 <Comune>'.$comune.'</Comune>
			 <Provincia>'.$prov.'</Provincia>
               <Nazione>'.$nazione_sigla.'</Nazione>
                </Sede>
            </CessionarioCommittente>';
			//fine dati cliente
       //dati intermediario
         $xml.='<TerzoIntermediarioOSoggettoEmittente>
		 <DatiAnagrafici>
                  <IdFiscaleIVA>
				  <IdPaese>SM</IdPaese>
				  <IdCodice>03473</IdCodice>
				  </IdFiscaleIVA>
				  <Anagrafica>
				  <Denominazione>Passepartout S.p.A</Denominazione>
				  </Anagrafica>
				  </DatiAnagrafici>
				  </TerzoIntermediarioOSoggettoEmittente>
				  <SoggettoEmittente>TZ</SoggettoEmittente>

				  </FatturaElettronicaHeader>';
   //fine header fattura
   //inizio nbody

   $aliquota='22.00';
   $esigibile=' <EsigibilitaIVA>I</EsigibilitaIVA>';


   $xml.='<FatturaElettronicaBody>
		<DatiGenerali>
            <DatiGeneraliDocumento>
            <TipoDocumento>TD01</TipoDocumento>
			<Divisa>EUR</Divisa>
			<Data>'.$data_fatt.'</Data>';
			    //formato data 2018-12-27
				 //formato importo 2 decimali fissi ivato 000.00
				 //importo al netto dello sconto e ivato

              $xml.='<Numero>'.$numFatt.'</Numero>';

//  <Importo>'.number_format($tot_sconto, 2,'.','').'</Importo>
			 $xml.='  <ImportoTotaleDocumento>'.number_format($importo, 2,'.','').'</ImportoTotaleDocumento>
			 <Causale>'.$mod.'</Causale>

                </DatiGeneraliDocumento>
        </DatiGenerali>';
        //prodotti
		  $t_imponibile=0;
        $xml.='<DatiBeniServizi>';

		//ciclo gli esami come nella stampa fattura
		$sql="select sum(totale) as impo, id_cat, tipo, count(*) as num from fatture_n
where id=0 ";
foreach($esami as $r){
	  $id_scheda=$r;

	  $sql.=" or id = '$id_scheda'";

}
$sql.=" group by tipo ";

$row=$db->sqlquery($sql);

$n_l=1;
//clinica
if($dest!='p'){
foreach($row as $r){


	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$r['id_cat']));
	$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=>$r['tipo']));
    $id_cat=$r['id_cat'];
    $tipo=$r['tipo'];
    $totale=$r['impo']; //2 decimali e punto invece di virgola
	$num=$r['num'];//2.000000 num deve avere 6 decimali
	$prezzo_uni=$totale/$num; //6 decimali
       //sconto 2 decimali

	  $xml.=' <DettaglioLinee>
             <NumeroLinea>'.$n_l.'</NumeroLinea>
               <CodiceArticolo>
                  <CodiceTipo>PROPRIETARIO</CodiceTipo>
                    <CodiceValore>'.$tipo.'</CodiceValore>
				</CodiceArticolo>
                <Descrizione>'.$nome_esame.'</Descrizione>
				<Quantita>'.number_format($num, 6,'.','').'</Quantita>
                <UnitaMisura>NR</UnitaMisura>
				<PrezzoUnitario>'.number_format($prezzo_uni, 6,'.','').'</PrezzoUnitario>';
				if($sconto!='' and $sconto>0) {

          $xml.='<ScontoMaggiorazione>
		  <Tipo>SC</Tipo>
		  <Percentuale>'.number_format($sconto, 2,'.','').'</Percentuale>
		  </ScontoMaggiorazione>';
		  $totale=$totale-(round($totale/100*$sconto,2));
        }


                 $xml.='<PrezzoTotale>'.number_format($totale,2,'.','').'</PrezzoTotale>
                <AliquotaIVA>'.$aliquota.'</AliquotaIVA>
               </DettaglioLinee>';
			   $n_l++;
			     $t_imponibile=$t_imponibile+$totale;
}
}
else{
foreach($row as $r){


	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$r['id_cat']));
	$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=>$r['tipo']));
$id_cat=$r['id_cat'];
$tipo=$r['tipo'];
    //$totale=$r['impo']; //2 decimali e punto invece di virgola
	   $totale=round(((100*$r['impo'])/122),2);

	   $num=$r['num'];//2.000000 num deve avere 6 decimali
	$prezzo_uni=$totale; //6 decimali
       //sconto 2 decimali

	  $xml.=' <DettaglioLinee>
             <NumeroLinea>'.$n_l.'</NumeroLinea>
               <CodiceArticolo>
                  <CodiceTipo>PROPRIETARIO</CodiceTipo>
                    <CodiceValore>'.$tipo.'</CodiceValore>
				</CodiceArticolo>
                <Descrizione>'.$nome_esame.'</Descrizione>
				<Quantita>'.number_format($num, 6,'.','').'</Quantita>
                <UnitaMisura>NR</UnitaMisura>
				<PrezzoUnitario>'.number_format($prezzo_uni, 6,'.','').'</PrezzoUnitario>';
				if($sconto!='' and $sconto>0) {

          $xml.='<ScontoMaggiorazione>
		  <Tipo>SC</Tipo>
		  <Percentuale>'.number_format($sconto, 2,'.','').'</Percentuale>
		  </ScontoMaggiorazione>';
		  $totale=$totale-(round($totale/100*$sconto,2));

        }


                 $xml.='<PrezzoTotale>'.number_format($totale,2,'.','').'</PrezzoTotale>
				 <AliquotaIVA>'.$aliquota.'</AliquotaIVA>
               </DettaglioLinee>';
			   $n_l++;
			     $t_imponibile=$t_imponibile+$totale;
}


}
//fine dettaglio beni
//spese trasporto
if($spe_tra!='' and $spe_tra>0){

	 $xml.=' <DettaglioLinee>
             <NumeroLinea>'.$n_l.'</NumeroLinea>
               <CodiceArticolo>
                  <CodiceTipo>PROPRIETARIO</CodiceTipo>
                    <CodiceValore>SPETRA</CodiceValore>
				</CodiceArticolo>
                <Descrizione>SPESE DI TRASPORTO</Descrizione>
				<Quantita>'.number_format(1, 6,'.','').'</Quantita>
                <UnitaMisura>NR</UnitaMisura>';
			$xml.='<PrezzoUnitario>'.number_format($spe_tra, 6,'.','').'</PrezzoUnitario>';
if($sconto!='' and $sconto>0) {

          $xml.='<ScontoMaggiorazione>
		  <Tipo>SC</Tipo>
		  <Percentuale>'.number_format($sconto, 2,'.','').'</Percentuale>
		  </ScontoMaggiorazione>';
		   $spe_tra=$spe_tra-(round($spe_tra/100*$sconto,2));
		
        }
                 $xml.='<PrezzoTotale>'.number_format($spe_tra,2,'.','').'</PrezzoTotale>
				 <AliquotaIVA>'.$aliquota.'</AliquotaIVA>
               </DettaglioLinee>';
			   $t_imponibile=$t_imponibile+$spe_tra;

}
//spese trasporto

	 $iva_tot=round($t_imponibile/100*22,2);
	 if($dest=='p'){
	 	$iva_tot=$importo-$t_imponibile;
	 }
	 if($dest!='p' and $utenza_estera=='s'){
		 $iva_tot=0;
		 $aliquota='N2.1';
		 $esigibile='';
	 }
				 //imponibile imposta 2 decimali
				 		 //MP05 bonifico
							 //MP12 riba
			//YYYY-MM-DD


/*
DataRiferimentoTerminiPagamento, GiorniTerminiPagamento, DataScadenzaPagamento, ImportoPagamento
*/


			$xml.='


			<DatiRiepilogo>
			            <AliquotaIVA>'.$aliquota.'</AliquotaIVA>
                <ImponibileImporto>'.number_format($t_imponibile,2,'.','').'</ImponibileImporto>
                 <Imposta>'.number_format($iva_tot,2,'.','').'</Imposta>
				'.$esigibile.'
				 </DatiRiepilogo>
				 </DatiBeniServizi>
				 <DatiPagamento>
				    <CondizioniPagamento>TP02</CondizioniPagamento>
					<DettaglioPagamento><ModalitaPagamento>'.$modalpag.'</ModalitaPagamento>
					<DataRiferimentoTerminiPagamento>'.$datarif.'</DataRiferimentoTerminiPagamento>
                    <GiorniTerminiPagamento>30</GiorniTerminiPagamento>
                    <DataScadenzaPagamento>'.$datasca.'</DataScadenzaPagamento>
                    <ImportoPagamento>'.number_format($importo, 2,'.','').'</ImportoPagamento>
					   <IBAN>IT49T0623049841000043964722</IBAN>
					</DettaglioPagamento>
                 </DatiPagamento>
				 </FatturaElettronicaBody>
				 </p:FatturaElettronica>';

fwrite($myXML, $xml);
fclose($myXML);
header("Location: index.php?req=fatturazione");
?>
