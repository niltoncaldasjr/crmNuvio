<?php
class OperadoraContatoDAO{
	/*-- propriedades --*/
	private $con;
	private $sql;
	private $objOperadoraContato;
	private $listaOperadoraContato = array();
	
	function __construct($con)
	{
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(OperadoraContato $objOperadoraContato){
		$this->sql = sprintf("INSERT INTO operadoracontato (descricao) VALUES('%s')",
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getDescricao() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(OperadoraContato $objOperadoraContato){
		$this->sql = sprintf("UPDATE operadoracontato SET descricao= '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objOperadoraContato;
	}
	
	/*-- Deletar --*/
	function deletar(OperadoraContato $objOperadoraContato){
		$this->sql = sprintf("DELETE FROM operadoracontato WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objOperadoraContato;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(OperadoraContato $objOperadoraContato){
		$this->sql = sprintf("SELECT * FROM operadoracontato WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objOperadoraContato = new OperadoraContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
		}
	
		return $this->objOperadoraContato;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(OperadoraContato $objOperadoraContato){
		$this->sql = "SELECT * FROM operadoracontato";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objOperadoraContato = new OperadoraContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaOperadoraContato, $this->objOperadoraContato);
		}
	
		return $this->listaOperadoraContato;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(OperadoraContato $objOperadoraContato){
		/*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM operadoracontato WHERE descricao like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objOperadoraContato->getEmpresa() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objOperadoraContato = new OperadoraContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaOperadoraContato, $this->objOperadoraContato);
		}
	
		return $this->listaOperadoraContato;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM operadoracontato limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM operadoracontato";
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