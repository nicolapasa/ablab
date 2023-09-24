<?php
/*
 * classe che genera label e form in modo dinamico 
 * @author npasa
 */

Class Form extends DB
{



	
    /**
     *
     * metodo che restituisce il nome e il tipo delle colonne di una tabella
     */
	public function getCol($t=null){
		
		
		if(is_null($t)){
			$ar=self::getTable();
		   foreach($ar as $a){
		   	foreach ($a as $t){
				foreach(parent::sqlquery("DESCRIBE $t") as $r){
						
						
					echo $r['Field'];
				
				}
		   	}	
		   }
		}
		else{
		return parent::sqlquery("DESCRIBE $t");
		
		}
		
	}
	/**
	 *
	 *
	 * metodo che restituisce la lista delle tabelle del db
	 * 
	 * */
	public function getTable(){
	
		return (parent::sqlquery("SHOW tables"));
	
	
	}

	/**
	 * Metodo che genera un campo di form con label 
	 *
	 */
	public function gen($t, $param=null)
	{
	//default
	//se param � null il form � vuoto
		if(!is_null($param)) {
			//interrogo anche i valori del campo
		     $row=self::selectAll($t, $param);
		}

		$e='';
	foreach(self::getCol($t) as $s){
		
	
		 $nomeCampo=$s['Field'];
		 

		if($nomeCampo!='id' )
			
		
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
			
			  if($tipo=='checkbox' or $tipo=='multiupload'){
			  
			  	$value=unserialize($row[0][$name]);
			  }
			  else if($tipo=='data' and $row[0][$name]!=0 )
			  	
			  	{
			  		//$value=Utility::getTime($row[0][$name]);
			  		$value=$row[0][$name];
			  	}
			  	else
			  	{
			  $value=$row[0][$name];
			$value=  stripslashes( mb_strtolower($value, 'UTF-8'));
			  }
			
			  $e.=' <div class="form-group">
						<label class=" control-label">'.$label.': </label> 
                
						';
			  
			  switch($tipo){
			  	case 'textarea':
			  		$e.= '<textarea cols="50" rows="8" name="'.$name.'" class="form-control '.$classe.'" id="'.$name.'"   >'.$value.'</textarea><br>';
			  		break;
			  	case 'select':
			  		//@todo devo prendere il campo associato all'id
			  		$e.= '<select name="'.$name.'" class="'.$classe.'"  id="'.$name.'" >';
			
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
			  			
			  		$e.='</select><br>';
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
			  		<br>
			  					<br>
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
			  			$e.= '<input  type="'.$tipo.'" name="'.$name.'[]" class="'.$classe.'" value="'.$o.'" '.$check.'  />'.$o.'</label><br>';
			  		
			  		}
			  		$e.='</div>';
			  		break;
			  	case 'radio':
			  		
			  		$e.='<div class="radio-list">';
			  		//ricevo le opzioni dall'array option
			  		foreach($opt as $o)		{
			  			$check='';
						if($o==1) $l='S';
						if($o==0) $l='N';
			  			if($o == $value) $check='checked=checked';
			  		    $e.='<label>';
			  			$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="'.$classe.'" value="'.$o.'" '.$check.'  />'.$l.'</label><br>';
			  		
			  		}
			  		$e.='</div>';
			  		break;
			  	case 'data':
			  	
			  		//if($value ==0) $value='';
			  		$e.= '<input data-date-format="dd/mm/yyyy"  type="text" name="'.$name.'" class=" date-picker"  value="'.$value.'"   /><br>';
			  		break;
			  	default:
			  		$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="form-control  '.$classe.'"  value="'.$value.'"  id="'. $campo_id.'" /><br>';
			  		break;
			  			
			  }
			  $e.=	'
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
	 * Metodo che genera un campo di form in base a parametri
	 *
	 */
	public function genCampo($t, $param=null,$nomeCampo)
	{
		//default
		//se param � null il form � vuoto
		if(!is_null($param)) {
			//interrogo anche i valori del campo
			$row=self::selectAll($t, $param);
		}
	
		$e='';
		
		
				foreach(self::selectAll('campi', array('value'=>$nomeCampo, 'tabella'=>$t)) as $c){
				//ricevo le info di quel campo
				$label=$c['label'];
				$tipo=$c['tipo'];
				$name=$c['value'];
				$classe=$c['classe'];
				$t_link=$c['tab_link'];
				$c_link=$c['campo_link'];
				$o_link=$c['opt_link'];
				if($c_link=='') $c_link='id';
				if($o_link=='') $o_link='value';
				$opt=explode(',',$c['opzioni']);
				if($tipo=='checkbox' or $tipo=='multiupload'){
						
					$value=unserialize($row[0][$name]);
				}
				else if($tipo=='data')
	
				{
					$value=Utility::getTime($row[0][$name]);
				}
				else
				{
					$value=$row[0][$name];
					$value=  stripslashes( mb_strtolower($value, 'UTF-8'));
				}
					
				$e.='<div class="form-group">
						<label class="col-md-4 control-label" for="'.$name.'">'.$label.': </label> <div class="col-md-8">	';
					
				switch($tipo){
					case 'textarea':
						$e.= '<textarea cols="50" rows="8" name="'.$name.'" class="'.$classe.'" id="'.$name.'"   >'.$value.'</textarea><br>';
						break;
					case 'select':
						//@todo devo prendere il campo associato all'id
						$e.= '<select name="'.$name.'" class="'.$classe.'"  id="'.$name.'" >';
						if($value!=''){
							//valorizzo in base alle opzioni
	
							$display=self::selectAll($t_link, array($c_link=>$value));
	
							$e.='<option value="'.$value.'" selected>'.$display[0][$o_link].'</option>';
							$display='';
						}
						//ricevo le opzioni dalla tabella collegata
						foreach(self::selectAll($t_link) as $l)		{
	
							$e .='<option value="'.$l[$c_link].'" >'.$l[$o_link].'</option>';
	
						}
						 
						$e.='</select><br>';
						break;
					case 'upload':
						$e.='
	
			  		<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
			  		<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
			  		<span class="fileupload-exists">Change</span><input name="'.$name.'" type="file" class="margin-none" /></span>
			  		<span class="fileupload-preview">';
						if($value!=''){
							$e.='	<img src="'.DIR_UPLOAD.$value.'"  />';
						}
						$e.='
			  		 </span>
			  		  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
			  		</div>
			  		';
	
						break;
					case 'multiupload':
						//se esistono valori in value poi nel save per l'update devo gestire nella tabella media le foto esistenti e fare l'update
						//opportuno degli indici
						foreach($value as $v){
	
							//v � l'id nella tabella media
							$val_img=self::getCampo('media', 'value', array('id'=>$v));
							$e.='
	
			  		<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
			  		<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
			  		<span class="fileupload-exists">Change</span><input name="value[]" type="file"  class="margin-none"  />
			  				<input type="hidden" name="id_foto[]" value="'.$v.'" />
			  				</span>
			  		<span class="fileupload-preview">
			  			<img src="'.DIR_UPLOAD.$val_img.'"  />
			  		 </span>
			  		  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
			  		</div>
			  		';
	
						}
						$e.='
	
			  		<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
			  		<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
			  		<span class="fileupload-exists">Change</span><input name="'.$name.'[]" type="file" multiple="multiple" class="margin-none" /></span>
			  		<span class="fileupload-preview">
	
			  		 </span>
			  		  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
			  		</div>
			  		';
	
						break;
					case 'checkbox':
						//ricevo le opzioni dall'array option
						foreach($opt as $o)		{
							$check='';
							if(in_array($o, $value)) $check='checked=checked';
							$e.='<label>';
							$e.= '<input  type="'.$tipo.'" name="'.$name.'[]" class="'.$classe.'" value="'.$o.'" '.$check.'  />'.$o.'</label><br>';
							 
						}
						break;
					case 'radio':
						 
						//ricevo le opzioni dall'array option
						foreach($opt as $o)		{
							$check='';
							if($o == $value) $check='checked=checked';
							$e.='<label>';
							$e.= '<input  type="'.$tipo.'" name="'.$name.'[]" class="'.$classe.'" value="'.$o.'" '.$check.'  />'.$o.'</label><br>';
							 
						}
						 
						break;
					case 'data':
						$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="data"  value="'.$value.'"  id="'.$name.'" /><br>';
						break;
					default:
						$e.= '<input  type="'.$tipo.'" name="'.$name.'" class="'.$classe.'"  value="'.$value.'"  id="'.$name.'" /><br>';
						break;
	
				}
				$e.=	'</div>
		</div>
			<div class="separator"></div>';
					
					
			}
		
	
	
	
		return $e;
	
	}
}	
