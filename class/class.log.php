<?php
/*
 * classe per gestire gli errori al sito
 * @author npasa
 */

Class Log extends DB
{


	/**
	 * Metodo che inserisce un record nella tabella log
	 *
	 */
	public function addLog($id=null, $c=null, $v )
	{
		
	
		$query =array( 'scheda'=>$id, 'contesto'=>$c, 
		'value'=>$v);
		parent::add('log',$query);
	}
}	