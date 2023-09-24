<?php
/*
 * classe per gestire gli errori al sito
 * @author npasa
 */

Class Err extends DB
{


	/**
	 * Metodo che inserisce un record nella tabella error
	 *
	 */
	public function addErr($c=null, $t=null, $v=null, $i=null )
	{
		
		if(is_null($c)) $c='frontend';
		if(is_null($t)) $t='warning';
		if(is_null($v)) $v='';
		if(is_null($i)) $i='';
		$query =array('time'=>time(),  'contesto'=>$c, 'tipo'=>$t, 'valore'=>$v, 'info'=>$i);
		parent::add('error',$query);
	}
}	