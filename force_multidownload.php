<?php
include("autoloader.php");
// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file

$dir = './XML/';

$db=new DB();

ob_start(); // This is only to show that ob_start can be called, however the buffer must be empty when sending.




$zip = new ZipArchive;


if($_POST['numfatt_da']!='' and $_POST['numfatt_a'] !=''  ){
  $numfatt_da=$_POST['numfatt_da'];
  $numfatt_a=$_POST['numfatt_a'];
    $nome_zip=  $numfatt_da.'-'.  $numfatt_a.'_'.$anno.'xml.zip';
  $numfatt_da=$numfatt_da-1;
  $numfatt_a=$numfatt_a+1;
  $anno=$_POST['anno_core'];

  $zip->open($nome_zip, ZipArchive::CREATE);

  $sql=" select * from fatture where num > '$numfatt_da' and num < '$numfatt_a' and anno='$anno' order by id asc ";


}
else{

  $dataF=$_POST['data_fatt'];

  $nome_zip=Utility::getData($dataF).'xml.zip';
  $zip->open($nome_zip, ZipArchive::CREATE);

  $sql=" select * from fatture where FROM_UNIXTIME(data,'%d/%m/%Y') = '$dataF' order by id asc ";

}




//$sql=" select * from fatture where data <= '$data_fatt' and data >= '$data_fatt_ini' order by id asc ";
foreach($db->sqlquery($sql) as $r){


$numFatt=$r['num'];
$anno=$r['anno'];
// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
$num_file=Utility::mettiZero(5, $numFatt);
 $fn =$anno.'/SM03473_'.$num_file.'.xml';
 $file_n =$dir . $fn;
 $zip->addFile($file_n);

}
 $zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$nome_zip);
header('Content-Length: ' . filesize($nome_zip));
readfile($nome_zip);
unlink($nome_zip);
?>
