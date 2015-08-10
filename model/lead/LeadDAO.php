<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';

class LeadDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objLead;
	private $listaLead = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(Lead $objLead){
		$this->sql = sprintf("INSERT INTO lead (empresa, email, telefone, contato, ativo) VALUES('%s', '%s', '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objLead->getEmpresa() ),
				mysqli_real_escape_string( $this->con, $objLead->getEmail() ),
				mysqli_real_escape_string( $this->con, $objLead->getTelefone() ),
				mysqli_real_escape_string( $this->con, $objLead->getContato() ),
				mysqli_real_escape_string( $this->con, $objLead->getAtivo() ));
		
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(Lead $objLead){
		$this->sql = sprintf("UPDATE lead SET empresa= '%s', email = '%s', telefone = %d, contato = '%s', dataedicao = '%s', ativo = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getEmpresa() ),
				mysqli_real_escape_string( $this->con, $objLead->getEmail() ),
				mysqli_real_escape_string( $this->con, $objLead->getTelefone() ),
				mysqli_real_escape_string( $this->con, $objLead->getContato() ),
				mysqli_real_escape_string( $this->con, $objLead->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objLead->getAtivo() ),
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objLead;
	}
	
	/*-- Deletar --*/
	function deletar(Lead $objLead){
		$this->sql = sprintf("DELETE FROM lead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objLead;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(Lead $objLead){
		$this->sql = sprintf("SELECT * FROM lead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLead->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objLead = new Lead($row->id, $row->empresa, $row->email, $row->telefone, $row->contato, $row->datacadastro, $row->dataedicao , $row->ativo); 
		}
		
		return $this->objLead;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(Lead $objLead){
		$this->sql = "SELECT * FROM lead";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objLead = new Lead($row->id, $row->empresa, $row->email, $row->telefone, $row->contato, $row->datacadastro, $row->dataedicao, $row->ativo); 
				
			array_push($this->listaLead, $this->objLead);
		}
		
		return $this->listaLead;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(Lead $objLead){
		 /*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM lead WHERE empresa like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objLead->getEmpresa() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
		
			$this->objLead = new Lead($row->id, $row->empresa, $row->email, $row->telefone, $row->contato, $row->datacadastro, $row->dataedicao, $row->ativo); 
		
			array_push($this->listaLead, $this->objLead);
		}
		
		return $this->listaLead;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM lead limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
			
		$lista = array();
		
		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$lista[]=$row;
		}
		//teste
		return $lista;
	}
	
	/*-- Quantidade Total --*/
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM lead";
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
			
}
?>