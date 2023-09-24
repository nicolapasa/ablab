<?php




if ($_POST['razza']=='0' and $_POST['razza_new'] !=''){
	$specie_new=Utility::clean($_POST['razza_new']);
    $_POST['razza']=$specie_new;
	
}

if ($_POST['organo']=='0' and $_POST['organo_new']!=''){
	//verifico che non esista già
	$campione_new=Utility::clean($_POST['organo_new']);
	$_POST['organo']=$campione_new;

}




?>