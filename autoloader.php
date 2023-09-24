<?php
/*
 * tutte le classi vanno incluse in questo file
 * 
 */
//includo le costanti

//in locale setto config.ini.test
if($_SERVER['HTTP_HOST']==  'localhost') { 
include('./config.ini.test.php');
}else if($_SERVER['HTTP_HOST']==  'nicolapasa.com') {

include('./config.ini.demo.php');
}else{
    include('./config.ini.php');

}

function my_autoloader($class) {
include './class/class.'.strtolower($class) . '.php';
}

spl_autoload_register('my_autoloader');
?>