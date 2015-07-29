<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';

class RotinaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objRotina;
	private $listaRotinaRotina = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(Rotina $objRotina){
		$this->sql = sprintf("INSERT INTO rotina (nome, descricao, subrotina, class, icon, ativo) VALUES('%s', '%s', %d, '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objRotina->getNome() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objRotina->getSubrotina() ),
				mysqli_real_escape_string( $this->con, $objRotina->getClass() ),
				mysqli_real_escape_string( $this->con, $objRotina->getIcon() ),
				mysqli_real_escape_string( $this->con, $objRotina->getAtivo() ) );
		
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(Rotina $objRotina){
		$this->sql = sprintf("UPDATE rotina SET nome= '%s', descricao = '%s', subrotina = %d, class = '%s', icon = '%s', ativo = %d, dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objRotina->getNome() ),
				mysqli_real_escape_string( $this->con, $objRotina->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objRotina->getSubrotina() ),
				mysqli_real_escape_string( $this->con, $objRotina->getClass() ),
				mysqli_real_escape_string( $this->con, $objRotina->getAtivo() ),
				mysqli_real_escape_string( $this->con, $objRotina->getIcon() ),
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
	function buscarPorId(Rotina $objRotina){
		$this->sql = sprintf("SELECT * FROM rotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objRotina->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->subrotina, $row->class, $row->icon, $row->ativo, $row->datacadastro, $row->dataedicao); 
		}
		
		return $this->objRotina;
	}
	
	/*-- listaRotinar Todos --*/
	function listaRotinarTodos(Rotina $objRotina){
		$this->sql = "SELECT * FROM rotina";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
				
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->subrotina, $row->class, $row->icon, $row->ativo, $row->datacadastro, $row->dataedicao);
				
			array_push($this->listaRotinaRotina, $this->objRotina);
		}
		
		return $this->listaRotinaRotina;
	}
	
	/*-- listaRotinar Por Nome --*/
	function listaRotinarPorNome(Rotina $objRotina){
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
		
			$this->objRotina = new Rotina($row->id, $row->nome, $row->descricao, $row->subrotina, $row->class, $row->icon, $row->ativo, $row->datacadastro, $row->dataedicao);
		
			array_push($this->listaRotinaRotina, $this->objRotina);
		}
		
		return $this->listaRotinaRotina;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM rotina limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
	while ( $row = mysqli_fetch_assoc ( $result ) ) {		
			$lista[]=$row;
		}
	//teste
		return $lista;
	}
	
	/*-- Quantidade Total --*/
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM rotina";
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