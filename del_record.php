<?
include("autoloader.php");


$db= new db();


$id=$_POST['id'];

 $id_tab=$db->getCampo('tabelle_data', 'id_tab', array('id'=>$id));

$db->delete('tabelle_data', $id);

//se la tabella non ha più record allora cancello anche la tabella 
$row=$db->selectAll('tabelle_data', array('id_tab'=>$id_tab));

if(count($row)==0) $db->delete('tabelle', $id_tab);
?>