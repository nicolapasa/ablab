<?php
/*
 * classe che genera label e form in modo dinamico 
 * @author npasa
 */

Class Form_ext extends Form
{



	
   

	/**
	 * Metodo che genera un campo di form con label formattato in modo diverso
	 *
	 */
	public function genEx($t)
	{
	

		$e='';
	foreach(self::getCol($t) as $s){
		
	
		 $nomeCampo=$s['Field'];
		 
		
		if($nomeCampo!='id')
		foreach(self::selectAll('campi', array('value'=>$nomeCampo, 'tabella'=>$t), ' id asc ') as $c){
			  //ricevo le info di quel campo 
			  $label=$c['label'];
			  $tipo=$c['tipo'];
			  $name=$c['value'];
			  $campo_id=$c['campo_id'];
			  $classe=$c['classe'];
			  $t_link=$c['tab_link'];
			  $c_link=$c['campo_link'];
			  $o_link=$c['opt_link'];
			  if($c_link=='') $c_link='id';
			  if($o_link=='') $o_link='value';
			  $opt=explode(',',$c['opzioni']);
			 
			  $value='<?php echo $'.$name.'; ?>';
			  
			
			  $e.=' <div class="form-group row">
						<label class="col-md-3 col-form-label">'.$label.': </label> 
                 <div class="col-md-6">
						';
			  
			  switch($tipo){
			  	case 'textarea':
			  		$e.= '<textarea   name="'.$name.'" class="form-control '.$classe.'" id="'.$name.'"   >'.$value.'</textarea>';
			  		break;
			  	case 'select':
			  		//@todo devo prendere il campo associato all'id
			  		$e.= '<select name="'.$name.'" class="form-control '.$classe.'"  id="'.$name.'" >';
			  		if($value!=''){
			  			//valorizzo in base alle opzioni
			  			
			  			$display=self::selectAll($t_link, array($c_link=>$value));
			  			
			  			$e.='<option value="'.$value.'" selected>'.$display[0][$o_link].'</option>';
			  			$display='';
			  		}
			  		else{
			  			$e.='<option value="" selected></option>';
			  			
			  		}
			  		//ricevo le opzioni dalla tabella collegata
			  		foreach(self::selectAll($t_link, null, ' '.$o_link.' asc ') as $l)		{
			  			
			  			$e .='<option value="'.$l[$c_link].'" >'.$l[$o_link].'</option>';
			  			
			  		}
			  				
			  		$e.='</select>';
			  		break;
			  	case 'upload':
			  		$e.='
			  	    <input type="file" name="'.$name.'">
			  		<span class="fileupload-preview">';
			  		if($value!=''){
			  			
			  			//determino estensione per capire se immagine
			  			if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$value))){
			  			$e.='	<img src="'.DIR_UPLOAD.$value.'"  />';
			  			}
			  			else{
			  				
			  			$e .= '<span>Nome File: '.$value.'</span>'	;
			  			}
			  		}
			  	    $e.='		
			  		 </span>
			  
			  		';

			  	break;	
			  	case 'multiupload':
			  		//se esistono valori in value poi nel save per l'update devo gestire nella tabella media le foto esistenti e fare l'update
			  		//opportuno degli indici
			  		foreach($value as $v){
			  			
			  			//v � l'id nella tabella media
			  			$val_img=self::getCampo('media', 'value', array('id'=>$v));
			  			$e.='
			  			   <input title="aggiorna file" type="file" name="value[]"  multiple="multiple" value="'.$v.'">
			  						<input type="hidden" name="id_foto[]" value="'.$v.'" />
			  		
			  		<span class="fileupload-preview">
			  			<img src="'.DIR_UPLOAD.$val_img.'" width="50" />
			  		 </span>
			  	
			  		';
			  			
			  		}
			     		
			  		$e.='
			  	 <label> Nuova foto:</label>			
			  	  <input name="'.$name.'[]" type="file" multiple="multiple"  />
			  	
			  		';
			  	
			  		break;
			  	case 'checkbox':
			  	//ricevo le opzioni dall'array option
			  	     $e.='<div class="checkbox-list">';
                                                 
			  		foreach($opt as $o)		{
			  			$check='';
			  			if(in_array($o, $value)) $check='checked=checked';
			  		    $e.='<label>';
			  			$e.= '<input  type="'.$tipo.'" name="'.$name.'[]" class="form-control '.$classe.'" value="'.$o.'" '.$check.'  />'.$o.'</label>';
			  		
			  		}
			  		$e.='</div>';
			  		break;
			  	case 'radio':
			  		
			  		$e.='<div class="radio-list">';
			  		//ricevo le opzioni dall'array option
			  		foreach($opt as $o)		{
			  			$check='';
						$e .= ' <?php ($'.$name.'=="'.$o.'")? $check="checked" : $check=""; ?>	';
			  		
			  		    $e.='<label class="radio-inline">';
			  			$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="form-control '.$classe.'" value="'.$o.'"  <?php echo $check;?>  />'.$o.'</label>';
			  		
			  		}
			  		$e.='</div>';
			  		break;
			  	case 'data':
			  	
			  		//if($value ==0) $value='';
			  		$e.= '<input data-date-format="dd/mm/yyyy"  type="text" name="'.$name.'" class="form-control date-picker"  value="'.$value.'"   />';
			  		break;
			  	default:
			  		$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="form-control  '.$classe.'"  value="'.$value.'"  id="'. $campo_id.'" />';
			  		break;
			  			
			  }
			  $e.=	'
		</div>
		</div>
			';
			  
			
		}
	}
	$e.= '<input  type="hidden" value="'.$t.'" name="action"   /><br>';
	if(!is_null($param)) 
	foreach($param as $k=>$v){
		$e.= '<input  type="hidden" value="'.$v.'" name="'.$k.'"   /><br>';
		
	}


 		return $e;
		
	}

		/**
	 * Metodo che genera elenco di valori 
	 *
	 */
	public function genValori($t)
	{
		
			foreach(parent::selectAll($t, null, ' id desc ', ' limit 1 ') as $row){
			
				foreach($row as $k=>$v){
				
				echo '$'.$k.'=$r[\''.$k.'\'];';
				echo '<br>';
				
			}
		    }		
		
	}
	/**
	 * Metodo che genera elenco campi
	 *
	 */
	public function genColonne($t)
	{
		
			foreach(parent::selectAll($t, null, ' id desc ', ' limit 1 ') as $row){
			
				foreach($row as $k=>$v){
				
				echo $k;
				echo '<br>';
				
			}
		    }		
		
	}
}	
