<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/imposto/Imposto.php';

class ImpostoDAO {
	private $con;
	private $sql;
	private $o_imposto;
	private $lista = array ();
	function __construct($con) {
		$this->con = $con;
	}
	function cadastrar(Imposto $o_imposto) {
		$this->sql = sprintf ( "INSERT INTO imposto (aliquotaICMS, aliquotaPIS, aliquotaCOFINS, aliquotaCSLL, aliquotaISS, aliquotaIRPJ, datacadastro, dataedicao) VALUES (%f, %f, %f, %f, %f, %f, '%s', '%s')", 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaICMS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaPIS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getaliquotaCOFINS() ),
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaCSLL() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaISS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaIRPJ() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getDatacadastro() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getDataedicao() ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		return mysqli_insert_id ( $this->con );
	}
	function atualizar(Imposto $o_imposto) {
		$this->sql = sprintf ( "UPDATE imposto SET aliquotaICMS= %f, aliquotaPIS= %f, aliquotaCOFINS= %f, aliquotaCSLL= %f, aliquotaISS= %f, aliquotaIRPJ= %f , dataedicao='%s' WHERE id= %d", 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaICMS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaPIS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getaliquotaCOFINS() ),
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaCSLL() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaISS() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getAliquotaIRPJ() ), 
				mysqli_real_escape_string ( $this->con, $o_imposto->getDataedicao() ),
				mysqli_real_escape_string ( $this->con, $o_imposto->getId()));
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		
	
	}
	function deletar(Imposto $o_imposto) {
		$this->sql = sprintf ( "DELETE FROM imposto WHERE id = %d", 
				mysqli_real_escape_string ( $this->con, $o_imposto->getId () ) );
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		return $o_imposto;
	}
	
	/* -- Buscar por ID -- */
	function buscarPorID(Imposto $o_imposto) {
		$this->sql = sprintf ( "SELECT * FROM imposto WHERE id = %d", 
				mysqli_real_escape_string ( $this->con, $o_imposto->getId () ) );
		
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			$this->o_imposto = new Imposto ( $row->id, $row->aliquotaICMS, $row->aliquotaPIS, $row->aliquotaCOFINS, $row->aliquotaCSLL, $row->aliquotaISS, $row->aliquotaIRPJ, $row->datacadastro, $row->dataedicao);
		}
		
		return $this->o_imposto;
	}
	
	/* -- Listar Todos -- */
	function listarTodos() {
		$this->sql = "SELECT * FROM imposto";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			$this->o_imposto = new Imposto (  $row->id, $row->aliquotaICMS, $row->aliquotaPIS, $row->aliquotaCOFINS, $row->aliquotaCSLL, $row->aliquotaISS, $row->aliquotaIRPJ, $row->datacadastro, $row->dataedicao );
			
			$this->lista [] = $this->o_imposto;
		}
		
		return $this->lista;
	}
	
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM imposto LIMIT " . $start . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
				
			$this->o_imposto = new Imposto (  $row->id, $row->aliquotaICMS, $row->aliquotaPIS, $row->aliquotaCOFINS, $row->aliquotaCSLL, $row->aliquotaISS, $row->aliquotaIRPJ, $row->datacadastro, $row->dataedicao );
				
			$this->lista [] = $this->o_imposto;
		}
	
		return $this->lista;
	}
	
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM imposto";
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
	function listarPorNome(Imposto $o_imposto) {
		/* -- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE -- */
		$this->sql = sprintf ( "SELECT * FROM usuario WHERE nome like '%s%s%s' ", mysqli_real_escape_string ( $this->con, '%' ), mysqli_real_escape_string ( $this->con, $o_imposto->getNome () ), mysqli_real_escape_string ( $this->con, '%' ) );
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			$this->o_imposto = new Imposto (  $row->id, $row->aliquotaICMS, $row->aliquotaPIS, $row->aliquotaCOFINS, $row->aliquotaCSLL, $row->aliquotaISS, $row->aliquotaIRPJ, $row->datacadastro, $row->dataedicao );
			
			$this->lista [] = $this->$o_imposto;
		}
		
		return $this->lista;
	}
}

