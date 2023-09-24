<?php
/*
 * classe per gestire i campi aggiornati 
 * @author npasa
 */

Class Update extends Form
{



//crea un oggetto con i campi modificati
    public function check_update($table=null, $id){

       
         $updated=array();


        $fields_array=self::getCol($table);
  

        foreach($fields_array as $field){
     
     
         if(isset($_POST[$field['Field']]) ){
          
 
            if(     trim(strtolower($_POST[$field['Field']])) != trim(strtolower(parent::getCampo($table, $field['Field'],array('id'=> $id))))  )   array_push( $updated, $field['Field']);
               
         }
            
        }

     return $updated;

    }







}