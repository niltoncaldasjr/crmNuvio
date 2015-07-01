<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/pais/Pais.php';
class PaisDAO {
	private $con;
	private $sql;
	private $o_pais;
	private $lista = array ();
	function __construct($con) {
		$this->con = $con;
	}
	function cadastrar(Pais $o_pais) {
		$this->sql = sprintf ( "INSERT INTO pais (descricao, nacionalidade, datacadastro, dataedicao) VALUES ('%s', '%s', '%s', '%s')", 
				mysqli_real_escape_string ( $this->con, $o_pais->getDescricao() ), 
				mysqli_real_escape_string ( $this->con, $o_pais->getNacionalidade() ), 
				mysqli_real_escape_string ( $this->con, $o_pais->getDatacadastro() ), 
				mysqli_real_escape_string ( $this->con, $o_pais->getDataedicao() ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		return mysqli_insert_id ( $this->con );
	}
	function atualizar(Pais $o_pais) {
		$this->sql = sprintf ( "UPDATE pais SET descricao= '%s', nacionalidade= '%s', dataedicao= '%s' WHERE id= %d", 
				mysqli_real_escape_string ( $this->con, $o_pais->getDescricao() ), 
				mysqli_real_escape_string ( $this->con, $o_pais->getNacionalidade() ),				
				mysqli_real_escape_string ( $this->con, $o_pais->getDataedicao() ), 				
				mysqli_real_escape_string ( $this->con, $o_pais->getId() ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}		
		
	}
	function deletar(Pais $o_pais) {
		$this->sql = sprintf ( "DELETE FROM pais WHERE id = %d", 
				mysqli_real_escape_string ( $this->con, $o_pais->getId() ) );
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		return $o_pais;
	}
	
	/* -- Buscar por ID -- */
	function buscarPorID(Pais $o_pais) {
		$this->sql = sprintf ( "SELECT * FROM pais WHERE id = %d", 
				mysqli_real_escape_string ( $this->con, $o_pais->getId() ) );
		
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {			
			
			$this->o_pais = new Pais ( $row->id, $row->descricao, $row->nacionalidade, $row->datacadastro, $row->dataedicao );
		}
		
		return $this->o_pais;
	}
	
	/* -- Listar Todos -- */
	function listarTodos() {
		$this->sql = "SELECT * FROM pais";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {		
			
			$this->o_pais = new Pais ( $row->id, $row->descricao, $row->nacionalidade, $row->datacadastro, $row->dataedicao );
			
			$this->lista [] = $this->o_pais;
		}
		
		return $this->lista;
	}
	
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM pais limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
				
// 			$this->o_pais = new Pais ( $row->id, $row->descricao, $row->nacionalidade, $row->datacadastro, $row->dataedicao );
				
// 			$this->lista [] = $this->o_pais;
			$lista[]=$row;
		}
	
		return $lista;
	}
	
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM pais";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		$total = 0;
		while ( $row = mysqli_fetch_object ( $result ) ) {	
			$total = $row->quantidade;
		}
	
		return $total;
	}
	
	/* -- Listar Por Nome -- */
	function listarPorNome(Pais $o_pais) {
		/* -- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE -- */
		$this->sql = sprintf ( "SELECT * FROM pais WHERE descricao like '%s%s%s' ", 
				mysqli_real_escape_string ( $this->con, '%' ), 
				mysqli_real_escape_string ( $this->con, $o_pais->getDescricao() ), 
				mysqli_real_escape_string ( $this->con, '%' ) );
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {			
			
			$this->o_pais = new Pais ( $row->id, $row->descricao, $row->nacionalidade, $row->datacadastro, $row->dataedicao );
			
			$this->lista [] = $this->o_pais;
		}
		
		return $this->lista;
	}
}

