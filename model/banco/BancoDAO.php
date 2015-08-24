<?php
class BancoDAO{
	/*-- propriedades --*/
	private $con;
	private $sql;
	private $objBanco;
	private $listaBanco = array();
	
	function __construct($con)
	{
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(Banco $objBanco){
		$this->sql = sprintf("INSERT INTO banco (nome, codigoBancoCentral) VALUES('%s', '%s')",
				mysqli_real_escape_string( $this->con, $objBanco->getNome() ),
				mysqli_real_escape_string( $this->con, $objBanco->getCodigoBancoCentral() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(Banco $objBanco){
		$this->sql = sprintf("UPDATE banco SET nome= '%s', codigoBancoCentral = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objBanco->getNome() ),
				mysqli_real_escape_string( $this->con, $objBanco->getCodigoBancoCentral() ),
				mysqli_real_escape_string( $this->con, $objBanco->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objBanco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objBanco;
	}
	
	/*-- Deletar --*/
	function deletar(Banco $objBanco){
		$this->sql = sprintf("DELETE FROM banco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objBanco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objBanco;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(Banco $objBanco){
		$this->sql = sprintf("SELECT * FROM banco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objBanco->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objBanco = new Banco($row->id, $row->nome, $row->codigoBancoCentral, $row->datacadastro, $row->dataedicao);
		}
	
		return $this->objBanco;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(Banco $objBanco){
		$this->sql = "SELECT * FROM banco";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objBanco = new Banco($row->id, $row->nome, $row->codigoBancoCentral, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaBanco, $this->objBanco);
		}
	
		return $this->listaBanco;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(Banco $objBanco){
		/*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM banco WHERE empresa like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objBanco->getEmpresa() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objBanco = new Banco($row->id, $row->nome, $row->codigoBancoCentral, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaBanco, $this->objBanco);
		}
	
		return $this->listaBanco;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM banco limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM banco";
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