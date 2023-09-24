<?php 

if($attached!=''){
	$pdf=__ROOT__.'/upload/'.$attached;
}
else{
	$pdf='';
}
foreach($utenza as $ut){

	$sql="select * from admin where id =$ut ";
    $row=$db->sqlquery($sql);
    foreach($row as $r){

        $id=$r['id'];
        
        if($sel_email=='' or $sel_email=='ref'){
        
         $email=array_unique(explode(';',$r['email']));
        }
        else{
        
             $email=array_unique(explode(';',$r['email_fatt']));
        }
        

        foreach($email as $e){

            //check se già inviata
            if(!$db->checkAlreadySend($e, $id_m)){
            
                $db->add('error', array('time'=>time(),  'contesto'=>'newsletter',
                'tipo'=>$id_m,  'info'=>$e));
            
            if($file!=''){
            Utility::inviaMailH(trim($e), $oggetto, $body, $pdf);
            
            }else{
            Utility::inviaMail(trim($e), $oggetto, $body, $pdf);
            
            }
            $cont++;
            
            }
            
            
            }

    }

}

//faccio update di mailing list
$db->update('mailing_list', array('completa'=>'s', 'id_last'=>$id), $id_m);