<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';

class RotinaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objRotina;
	private $listaRotina = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(Rotina $objRotina){
		$this->sql = sprintf("INSERT INTO rotina (nome, descricao, ordem, url, ativo, datacadastro, dataedicao) VALUES('%s', '%s', %d, '%s', %d, '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objRotina->getNome() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objRotina->getOrdem() ),
				mysqli_real_escape_string( $this->con, $objRotina->getUrl() ),
				mysqli_real_escape_string( $this->con, $objRotina->getAtivo() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDatacadastro() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDataedicao() ) );
		
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
	
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(Rotina $objRotina){
		$this->sql = sprintf("UPDATE rotina SET nome= '%s', descricao = '%s', ordem = %d, url = '%s', ativo = %d, dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objRotina->getNome() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objRotina->getOrdem() ),
				mysqli_real_escape_string( $this->con, $objRotina->getUrl() ),
				mysqli_real_escape_string( $this->con, $objRotina->getAtivo() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objRotina;
	}
	
	/*-- Deletar --*/
	function deletar(Rotina $objRotina){
		$this->sql = sprintf("DELETE FROM rotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objRotina;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorID(Rotina $objRotina){
		$this->sql = sprintf("SELECT * FROM rotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objRotina->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->ordem, $row->url, $row->ativo, $row->datacadastro, $row->dataedicao); 
		}
		
		return $this->objRotina;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(Rotina $objRotina){
		$this->sql = "SELECT * FROM rotina";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->ordem, $row->url, $row->ativo, $row->datacadastro, $row->dataedicao);
				
			array_push($this->listaRotina, $this->objRotina);
		}
		
		return $this->listaRotina;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(Rotina $objRotina){
		 /*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM rotina WHERE nome like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objRotina->getNome() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
		
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->ordem, $row->url, $row->ativo, $row->datacadastro, $row->dataedicao);
		
			array_push($this->listaRotina, $this->objRotina);
		}
		
		return $this->listaRotina;
	}
			
}
?>