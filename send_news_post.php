<?php

//prima controllo che non ci siano ancora risposte inevase

if (count($db->selectAll('mailing_list', array('completa'=>'n', 'id_news'=>$id_topic)))==0){


$db->add('mailing_list', array('id_news'=>$id_topic, 'completa'=>'n', 'id_last'=>0, 'tipo'=>'forum_r'));


}



?>