<?php

/*
 * classe per db
 */
class DB {

	// parametri db
	public $db_host;
	public $db_user;
	public $db_password;
	public $db_name;
	public $table;
	private static $connection;

	// proprieta paginazione
	public $tot_pages;
	public $current_page;
	public $per_pages;
	public $tot_records;

	// costruttore della classe
	// db di test online
      public function __construct($conn = array( 'db_host'=>DB_HOST, 'db_user'=>DB_USER, 'db_password'=>DB_PASS, 'db_name'=>DB_NAME)) {
		$this->table = strtolower ( get_class ( $this ) );

		if (! is_null ( $conn )) {
			foreach ( $conn as $key => $val ) {
				$this->$key = $val;
			}
			if (! isset ( self::$connection )) {
				$this->connetti ();
			}
		}
	}

	/*
	 * esegue la connessione al db
	 */
	public function connetti() {
		self::$connection = new mysqli ( $this->db_host, $this->db_user, $this->db_password, $this->db_name );
	}


	/*
	 * metodo per inserire un record in una tabella
	 */
	public function add($table = null, $param = null) {
		if (is_null ( $table ))
			$table = $this->table;
		$values = '(';
		$labels = '(';
		// unset($param['action']);
		$i = count ( $param );
		$i --;
		$c = 0;

		foreach ( $param as $nome_campo => $value ) {
			$value = addslashes ( $value );
			($c == $i) ? $labels .= $nome_campo : $labels .= $nome_campo . ', ';
			($c == $i) ? $values .= "'" . $value . "'" : $values .= "'" . $value . "',";

			$c ++;
		}
		$values .= ') ';
		$labels .= ') ';
		$q = "INSERT INTO " . $table . ' ' . $labels . " VALUES " . $values;
		self::$connection->query ( $q ) or mysqli_errno ( self::$connection );

	 if(mysqli_error ( self::$connection ) !='') Err::addErr('insert in tabella', 'errore', mysqli_error ( self::$connection ), $q);

		return mysqli_insert_id ( self::$connection );
	}
	/*
	 * metodo per aggiornare un record in una tabella
	 */
	public function update($table = null, $param = null, $id = null) {
		// unset($param['action']);
		if (is_null ( $table ))
			$table = $this->table;
		$i = count ( $param );
		$i --;
		$c = 0;
		foreach ( $param as $nome_campo => $value ) {
			$value = addslashes ( $value );

			($c == $i) ? $values .= $nome_campo . "= '" . $value . "'" : $values .= $nome_campo . "= '" . $value . "', ";
			$c ++;
		}

	    $q = "UPDATE " . $table . ' set  ' . $values . " where id= '$id'";
		self::$connection->query ( $q );
		 if(mysqli_error ( self::$connection ) !='') Err::addErr('update in tabella', 'errore', mysqli_error ( self::$connection ), $q);

		return true;
	}
	/*
	 * metodo per aggiornare un record in una tabella
	*/
	public function updateP($table = null, $param = null, $param_id = null) {

		if (is_null ( $table ))
			$table = $this->table;
		$i = count ( $param );
		$i --;
		$c = 0;
		foreach ( $param as $nome_campo => $value ) {
			$value = addslashes ( $value );

			($c == $i) ? $values .= $nome_campo . "= '" . $value . "'" : $values .= $nome_campo . "= '" . $value . "', ";
			$c ++;
		}
		$i = count ( $param_id );
		$i --;
		$c = 0;

		foreach ( $param_id as $nome_campo => $value ) {
			$value = addslashes ( $value );

			($c == $i) ? $values2 .= $nome_campo . "= '" . $value . "'" : $values2 .= $nome_campo . "= '" . $value . "' and ";
			$c ++;
		}
		$q = "UPDATE " . $table . ' set  ' . $values . " where " . $values2 ." ";
		self::$connection->query ( $q );
		 if(mysqli_error ( self::$connection ) !='') Err::addErr('update in tabella', 'errore', mysqli_error ( self::$connection ), $q);

		return true;
	}
	/*
	 * metodo per cancellare un record in una tabella
	 */
	public function delete($table = null, $id = null) {
		if (is_null ( $table ))
			$table = $this->table;
		$q = "delete from " . $table . " where id= '$id'";
		self::$connection->query ( $q );
		if(mysqli_error ( self::$connection ) !='') Err::addErr('delete da tabella', 'errore', mysqli_error ( self::$connection ), $q);

		return true;
	}
	/*
	 * metodo per cancellare un record in una tabella
	*/
	public function deleteP($table = null, $param_id = null) {
		if (is_null ( $table ))
			$table = $this->table;
		$i = count ( $param_id );
		$i --;
		$c = 0;
		foreach ( $param_id as $nome_campo => $value ) {
			$value = addslashes ( $value );

			($c == $i) ? $values .= $nome_campo . "= '" . $value . "'" : $values .= $nome_campo . "= '" . $value . "' and ";
			$c ++;
		}
		$q = "delete from " . $table . " where ".$values." ";
		self::$connection->query ( $q );
		if(mysqli_error ( self::$connection ) !='') Err::addErr('delete da tabella', 'errore', mysqli_error ( self::$connection ), $q);

		return true;
	}
	/*
	 * fetch di una tabella con parametro query
	 */
	public function sqlquery($q) {

		$result = self::$connection->query ( $q );
   // echo $q;
		if(mysqli_error ( self::$connection ) !='') Err::addErr('fetch tabella', 'errore', mysqli_error ( self::$connection ), $q);

		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {

			$ar [] = $row;
		}
		return $ar;
	}
	/*
	 * fetch di una tabella con parametro query
	*/
	public function sqlqueryRes($q) {
	return	$result = self::$connection->query ( $q );

	}
	/*
	 * metodo per ottenere le informazioni dall'host
	*/
	public function getInfo() {
		return	 self::$connection->host_info;

	}
	/*
	 * metodo per ottenere le informazioni dal server
	*/
	public function getInfoServer() {
		return	mysqli_get_server_info( self::$connection);

	}
	/*
	 * fetch di una tabella con parametri e order
	 */
	public function selectAll($table = null, $param = null, $order = null, $limit = null) {
		if (is_null ( $table ))
			$table = $this->table;
		if (is_null ( $param )) {
			$where = '';
		} else {
			$where = ' where ';
			$i = count ( $param );
			$i --;
			$c = 0;

			foreach ( $param as $key => $val ) {

				($c == $i) ? $where .= $key . " =  '" . $val . "'" : $where .= $key . " =  '" . $val . "' and ";
				$c ++;
			}
		}
		(is_null ( $order )) ? $order = '' : $order = ' order by ' . $order . ' ';
		if (is_null ( $limit ))
			$limit = '';
		$q = 'select * from ' . $table . $where . $order . $limit;
		$result = self::$connection->query ( $q );
		if(mysqli_error ( self::$connection ) !='') Err::addErr('fetch tabella', 'errore', mysqli_error ( self::$connection ), $q);

		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {

			$ar [] = $row;
		}
		return $ar;

	}
	/*
	 * fetch di una tabella con parametri per ricerca
	*/
	public function searchAll($table = null, $param = null, $order = null, $limit = null) {
		if (is_null ( $table ))
			$table = $this->table;
		if (is_null ( $param )) {
			$where = '';
		} else {
			$where = ' where ';
			$i = count ( $param );
			$i --;
			$c = 0;

			foreach ( $param as $key => $val ) {

				($c == $i) ? $where.= $key. " like  '%" . $val ."%'" : $where.= $key. " like  '%" . $val ."%' and ";
				$c ++;
			}
		}
		(is_null ( $order )) ? $order = '' : $order = ' order by ' . $order . ' ';
		if (is_null ( $limit ))
			$limit = '';
		$q = 'select * from ' . $table . $where . $order . $limit;
		$result = self::$connection->query ( $q ) ;
		if(mysqli_error ( self::$connection ) !='') Err::addErr('fetch tabella con ricerca', 'errore', mysqli_error ( self::$connection ), $q);

		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {

			$ar [] = $row;
		}
		return $ar;
		//return Utility::arrayToObject($ar);
	}
	/*
	 * metodo che restituisce il valore di un campo
	 */
	public function getCampo($table = null, $campo = null, $param = array(), $order=null, $limit=null) {
		if (is_null ( $campo ))
			$campo = 'id';
		if (is_null ( $table ))
			$table = $this->table;

		$row = $this->selectAll ( $table, $param, $order , $limit);
		if(count($row)>0)
		foreach ( $row as $r ) {
			if(is_null($r [$campo])) Err::addErr('fetch per trovare un campo', 'errore','il campo non esiste in tabella', $campo);
			return $r [$campo];
		}
	}
	public function getLast($id_t){

		$row=$this->selectAll('for_post', array('id_topic'=>$id_t), '  id desc ',' limit 1 ');
		$last='';
		foreach($row as $r){


			$id_autore=$r['id_admin'];
			$autore=$this->getCampo('admin', 'nome', array('id'=>$id_autore));
			$data = Utility::getTime($r['data']);
			$ora = Utility::getTime2($r['data']);
			$last=' di '.$autore.' inviato il '.$data.' alle ore '.$ora;

		}
		return $last;
	}
	/*
	 * metodo per eseguire la paginazione
	 */
	public function pagina($table = null, $per_page = 50, $param = null, $order = null, $oper=null) {
		if (is_null ( $order ))
			$order = '';
		if (is_null ( $table ))
			$table = $this->table;
		if (is_null ( $oper ))
			$oper = 'and';
		if (is_null ( $param )) {

			$tot_records = count ( self::selectAll ( $table, $param, $order ) );
		} else {
			$where = '';
			$t = count ( $param );
			$c = 1;
			foreach ( $param as $campo => $value ) {

				($value == '') ? $value = '%' : $value = '%' . $value . '%';
				($c < $t) ? $where .= " " . $campo . "  like '" . $value . "' " . $oper.  "  " : $where .= " " . $campo . "  like '" . $value . "' ";
				$c ++;
			}

		$sql = ' select * from ' . $table . ' where ' . $where . ' order by ' . $order;

			$tot_records = count ( self::sqlquery ( $sql ) );
		}

		// risultati per pagina(secondo parametro di LIMIT)

		// numero totale di pagine
		$tot_pages = ceil ( $tot_records / $per_page );
		$this->tot_pages = $tot_pages;
		// pagina corrente
		$current_page = (! $_GET ['page']) ? 1 : ( int ) $_GET ['page'];
		$this->current_page = $current_page;
		// primo parametro di LIMIT
		$primo = ($current_page - 1) * $per_page;
		if (is_null ( $param )) {
			$limit = ' limit ' . $per_page . ' offset ' . $primo . ' ';
			$row = self::selectAll ( $table, null, $order, $limit );
		} else {

			$sql = ' select * from ' . $table . ' where ' . $where . ' order by ' . $order . ' limit ' . $per_page . ' offset ' . $primo . ' ';

			$row = self::sqlquery ( $sql );
		}

		return $row;
	}
	/*
	 * metodo per eseguire la paginazione con parametri senza like
	*/
	public function paginaNolike($table = null, $per_page = 50, $param = null, $order = null, $oper=null) {



		$this->per_pages=$per_page;//memorizzo il numero per pagina


		if (is_null ( $order ))
			$order = '';
		if (is_null ( $table ))
			$table = $this->table;
		if (is_null ( $oper ))
			$oper = 'and';
		if (is_null ( $param )) {

			$tot_records = count ( self::selectAll ( $table, $param, $order ) );
		} else {
			$where = '';
			$t = count ( $param );
			$c = 1;
			foreach ( $param as $campo => $value ) {

				//($value == '') ? $value = '%' : $value = '%' . $value . '%';
				($c < $t) ? $where .= " " . $campo . "  = '" . $value . "' " . $oper.  "  " : $where .= " " . $campo . "  like '" . $value . "' ";
				$c ++;
			}

			$sql = ' select * from ' . $table . ' where ' . $where . ' order by ' . $order;

			$tot_records = count ( self::sqlquery ( $sql ) );
		}

		// risultati per pagina(secondo parametro di LIMIT)
	    $this->tot_records=$tot_records; //memorizzo il numero totale di record
		// numero totale di pagine
		$tot_pages = ceil ( $tot_records / $per_page );
		$this->tot_pages = $tot_pages;
		// pagina corrente
		$current_page = (! $_GET ['page']) ? 1 : ( int ) $_GET ['page'];
		$this->current_page = $current_page;
		// primo parametro di LIMIT
		$primo = ($current_page - 1) * $per_page;
		if (is_null ( $param )) {
			$limit = ' limit ' . $per_page . ' offset ' . $primo . ' ';
			$row = self::selectAll ( $table, null, $order, $limit );
		} else {

			$sql = ' select * from ' . $table . ' where ' . $where . ' order by ' . $order . ' limit ' . $per_page . ' offset ' . $primo . ' ';

			$row = self::sqlquery ( $sql );
		}

		return $row;
	}
	/*
	 * metodo per eseguire la paginazione con sql
	*/
	public function paginaSql($sql,$per_page = 50) {


		    $this->per_pages=$per_page;//memorizzo il numero per pagina

			$tot_records = count ( self::sqlquery ( $sql ) );
			$this->tot_records=$tot_records; //memorizzo il numero totale di record

		// risultati per pagina(secondo parametro di LIMIT)

		// numero totale di pagine
		$tot_pages = ceil ( $tot_records / $per_page );
		$this->tot_pages = $tot_pages;
		// pagina corrente
		$current_page = (! $_GET ['page']) ? 1 : ( int ) $_GET ['page'];
		$this->current_page = $current_page;
		// primo parametro di LIMIT
		$primo = ($current_page - 1) * $per_page;


			$limit = ' limit ' . $per_page . ' offset ' . $primo . ' ';
 $sql =$sql.$limit;

			$row = self::sqlquery ( $sql );


		return $row;
	}
	/*
	 * metodo per eseguire la paginazione con un array di id
	*/
	public function paginaId($el,$per_page = 50) {



		$ar= array_chunk($el, $per_page);

		// risultati per pagina(secondo parametro di LIMIT)

		// numero totale di pagine
		$tot_pages = count($ar);
		$this->tot_pages = $tot_pages;
		// pagina corrente
		$current_page = (! $_GET ['page']) ? 1 : ( int ) $_GET ['page'];
		$this->current_page = $current_page;
		// primo parametro di LIMIT

		return $ar[$current_page-1];


	}
	/*
	 * metodo per stampare la paginazione accetta come parametri la pagina attuale, il totale delle pagine, il tipo di paginazione array di search e filtri param fa riferimento alla tabella da fetchare
	 */
	public function printPagina($tipo = 0, $param, $search = null) {
		if (is_null ( $search )) {
			$search = '';
		} else {
			$str = '';
			foreach ( $search as $k => $v ) {

				$str .= '&' . $k . '=' . $v;
			}
		}
		// tipo 0 paginazione con prev e next
		// tipo 1 paginazione con pulsanti numero pagina
		switch ($tipo) {
			case 0 :
				if ($this->tot_pages > 1) {


					//$this->per_pages
					if ($this->current_page == 1) {
						$from=1;
					}
					else{
					$from=($this->per_pages * ($this->current_page-1))+1;
					}
					if ($this->current_page == $this->tot_pages) {

						$to=$this->tot_records;

					}
					else{
					$to=$from +$this->per_pages-1;
					}
					$paginazione_a = "
							<div class='row'>

							<div class='col-md-6'>

							<div class='dataTables_info'>mostra da $from a  $to di $this->tot_records valori</div>


							</div>
					<div class='col-md-6'>
					<div class='dataTables_paginate paging_bootstrap'>
					<ul class='pagination'>

					";




					if ($this->current_page == 1) { // se siamo nella prima pagina
				        $first= "<li><a class='disabled'>	← First</a></li>";
						$precedente = "<li><span class='disabled'>&laquo;PREV</span></li>";
					} else {
						$previous_page = $this->current_page - 1;
						$first= "<li><a class='active' href='index.php?req=$param&$str'>	← First</a></li>";
						$precedente = "<li><a class='active' href='index.php?req=$param&page=$previous_page$str'  title='$previous_page'>&laquo;PREV</a></li>";
					}

					if ($this->current_page == $this->tot_pages) { // se siamo nell�ultima pagina
						$last= "<li><a class='disabled'>	Last → </a></li>";
						$successiva = "<li><span class='disabled'>NEXT &raquo;</span></li>";
					} else { // altrimenti
						$next_page = ($this->current_page + 1);
						$last= "<li><a class='active' href='index.php?req=$param&page=$this->tot_pages&$str'>	Last → </a></li>";
						$successiva = "<li><a class='active' href='index.php?req=$param&page=$next_page$str'  title='$next_page'>NEXT &raquo;</a></li> ";
					}
					$paginazione_a .= "$first $precedente   $successiva $last";

					$paginazione_a .= "</ul></div></div></div>";
				}

				break;
				case 1 :
					if ($this->tot_pages > 1) {
						$paginazione_a = "<div class='pagination'>";

						if ($this->current_page == 1) { // se siamo nella prima pagina
							$precedente = "<span class='disabled'>&laquo;PREV</span>";
						} else {
							$previous_page = $this->current_page - 1;
							$precedente = "<a class='active' href='gallery.php?tipo=$param&page=$previous_page$str'  title='$previous_page'>&laquo;PREV</a>";
						}

						if ($this->current_page == $this->tot_pages) { // se siamo nell�ultima pagina
							$successiva = "<span class='disabled'>NEXT &raquo;</span>";
						} else { // altrimenti
							$next_page = ($this->current_page + 1);
							$successiva = "<a class='active' href='gallery.php?tipo=$param&page=$next_page$str'  title='$next_page'>NEXT &raquo;</a> ";
						}
						$paginazione_a .= "$precedente   $successiva";

						$paginazione_a .= "</div>";
					}

					break;
					case 2 :
						if ($this->tot_pages > 1) {
							$paginazione_a = "<div class='pagination'>";

							if ($this->current_page == 1) { // se siamo nella prima pagina
								$precedente = "<span class='disabled'>&laquo;PREV</span>";
							} else {
								$previous_page = $this->current_page - 1;
								$precedente = "<a class='active' href='categorie.php?name=$param&page=$previous_page$str'  title='$previous_page'>&laquo;PREV</a>";
							}

							if ($this->current_page == $this->tot_pages) { // se siamo nell�ultima pagina
								$successiva = "<span class='disabled'>NEXT &raquo;</span>";
							} else { // altrimenti
								$next_page = ($this->current_page + 1);
								$successiva = "<a class='active' href='categorie.php?name=$param&page=$next_page$str'  title='$next_page'>NEXT &raquo;</a> ";
							}
							$paginazione_a .= "$precedente   $successiva";

							$paginazione_a .= "</div>";
						}

						break;
						case 3 :
							if ($this->tot_pages > 1) {
								$paginazione_a = "<div class='pagination'>";

								if ($this->current_page == 1) { // se siamo nella prima pagina
									$precedente = "<span class='disabled'>&laquo;PREV</span>";
								} else {
									$previous_page = $this->current_page - 1;
									$precedente = "<a class='active' href='search.php?chiave=$param&page=$previous_page$str'  title='$previous_page'>&laquo;PREV</a>";
								}

								if ($this->current_page == $this->tot_pages) { // se siamo nell�ultima pagina
									$successiva = "<span class='disabled'>NEXT &raquo;</span>";
								} else { // altrimenti
									$next_page = ($this->current_page + 1);
									$successiva = "<a class='active' href='search.php?chiave=$param&page=$next_page$str'  title='$next_page'>NEXT &raquo;</a> ";
								}
								$paginazione_a .= "$precedente   $successiva";

								$paginazione_a .= "</div>";
							}

							break;
		}

		return $paginazione_a;
	}


	/*
	 * Metodo che restituisce la chiave primaria pi� alta della tabelle o il campo
	*/
	public function getMax($table, $campo=null){
		if(is_null($campo)) $campo='id';
		$q='select max('.$campo.') from '.$table;
		$row= self::sqlquery($q);

		return $row[0]['max('.$campo.')'];

	}
	/*
	 * Metodo che restituisce la chiave primaria pi� alta della tabelle o il campo con parametri
	*/
	public function getMaxP($table, $campo=null, $param){
		if(is_null($campo)) $campo='id';
		if (is_null ( $param )) {
			$where = '';
		} else {
			$where = ' where ';
			$i = count ( $param );
			$i --;
			$c = 0;

			foreach ( $param as $key => $val ) {

				($c == $i) ? $where .= $key . " =  '" . $val . "'" : $where .= $key . " =  '" . $val . "' and ";
				$c ++;
			}
		}
		$q='select max('.$campo.') from '.$table.$where;
		$row= self::sqlquery($q);

		return $row[0]['max('.$campo.')'];

	}
	/*
	 * chiusura della connessione
	 */
	public function close() {
		self::$connection->close ();
	}


	/*
	 *
	 * metodo che controlla se esiste già un campo in una tabella
	 *
	 */
	public function checkCampo($table, $campo, $nome)
	{

		//eseguo la fetch della tabella utenti

		$row= self::selectAll($table);

		$check='true';

		foreach ($row as $r){


			if ($campo == $r[$nome]){

				$check='false';
			}



		}

		return $check;

	}
		/*
	 *
	 * metodo che controlla se esiste già un campo in una tabella
	 *
	 */
	public function checkRec($table, $param)
	{

		if(count(self::selectAll($table, $param))>0)

		return true;

	}


	public function checkRecJson($table, $param)
	{
    $check='true';
		if(count(self::selectAll($table, $param))>0) $check='false';


			return $check;

	}
	/*
	 *
	 * backup del db
	 */
	public function backup($filename){

		$dumper = new MySQLDump($this->db_name,$filename,false,false);
		$dumper->doDump();
	}

	public function escape($val) {
			return self::$connection->real_escape_string($val);

		}
}
