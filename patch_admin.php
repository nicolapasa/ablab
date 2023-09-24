<?php
include("./autoloader.php");

$db= new DB();

$sql="select * from admin  order by id asc";
$row=$db->sqlquery($sql);
//echo count($row);
foreach($row as $r)
{
	$id=$r['id'];
	echo $nome=$r['nome'];
	$provincia=$r['provincia'];
	$comune=$r['comune'];
	if(is_numeric($provincia)) $provincia=$db->getCampo('province', 'nomeprovincia', array('id'=>$provincia));
	if(is_numeric($comune)) $comune=$db->getCampo('comuni', 'nomecomune', array('id'=>$comune));
	 $db->update('admin', array('provincia'=>$provincia, 'comune'=>$comune), $id);

}
//echo phpinfo();
