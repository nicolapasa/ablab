<?php
include("autoloader.php");
// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file

$dir = './fatture/';

$db=new DB();

ob_start(); // This is only to show that ob_start can be called, however the buffer must be empty when sending.




  $dataF=$_GET['data_fatt'];
  if($_GET['numfatt_da']!='' and $_GET['numfatt_a'] !=''  ){
    $numfatt_da=$_GET['numfatt_da'];
    $numfatt_a=$_GET['numfatt_a'];
      $nome_zip=  $numfatt_da.'-'.  $numfatt_a.'_'.$anno.'fat.zip';
    $numfatt_da=$numfatt_da-1;
    $numfatt_a=$numfatt_a+1;
    $anno=$_GET['anno_core'];
        $sql=" select * from fatturate2_v where num > '$numfatt_da' and num < '$numfatt_a' and anno='$anno'   order by id asc ";
  }
  else{
      $sql=" select * from fatturate2_v where FROM_UNIXTIME(data,'%d/%m/%Y') = '$dataF'  order by id asc ";
         $nome_zip=Utility::getData($dataF).'fat.zip';
  }




if(count($db->sqlquery($sql))>0){
	$zip = new ZipArchive;


  $zip->open($nome_zip, ZipArchive::CREATE);

 foreach($db->sqlquery($sql) as $r){
$dest=$r['dest'];

$numFatt=$r['num'];
$idFatt=$r['id'];
$anno=$r['anno'];

$nominativo=Utility::pulisciNome(Utility::iniziali($r['nominativo']));
// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
$fn=$db->getCampo('fatture', 'nome_file', array('id'=>$idFatt));
//$fn=$anno.'-'.$numFatt.'-'.$nominativo.'.pdf';


 $file_n = $dir . $fn;
   // $zip->zip_add($file_n); // adding two files as an array
 $file_n =$dir . $fn;


 $zip->addFile($file_n);

 if($dest!='p'){
	//$fn2=$anno.'-'.$numFatt.'-'.$nominativo.'-allegato.pdf';
  $fn2=$db->getCampo('fatture', 'nome_alle', array('id'=>$idFatt));

 $file_n2 = $dir . $fn2;

 $zip->addFile($file_n2);
 }
}

 $zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$nome_zip);
header('Content-Length: ' . filesize($nome_zip));
readfile($nome_zip);
unlink($nome_zip);

}
else{
		header("Location: index.php?req=pdf_fat&data_fatt=$dataF");
}
?>
