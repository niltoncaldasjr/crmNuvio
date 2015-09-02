<?php
class TipoContatoDAO{
	/*-- propriedades --*/
	private $con;
	private $sql;
	private $objTipoContato;
	private $listaTipoContato = array();
	
	function __construct($con)
	{
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(TipoContato $objTipoContato){
		$this->sql = sprintf("INSERT INTO tipocontato (descricao) VALUES('%s')",
				mysqli_real_escape_string( $this->con, $objTipoContato->getDescricao() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(TipoContato $objTipoContato){
		$this->sql = sprintf("UPDATE tipocontato SET descricao= '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoContato->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objTipoContato->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objTipoContato->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objTipoContato;
	}
	
	/*-- Deletar --*/
	function deletar(TipoContato $objTipoContato){
		$this->sql = sprintf("DELETE FROM tipocontato WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoContato->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objTipoContato;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(TipoContato $objTipoContato){
		$this->sql = sprintf("SELECT * FROM tipocontato WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoContato->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objTipoContato = new TipoContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
		}
	
		return $this->objTipoContato;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(TipoContato $objTipoContato){
		$this->sql = "SELECT * FROM tipocontato";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objTipoContato = new TipoContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaTipoContato, $this->objTipoContato);
		}
	
		return $this->listaTipoContato;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(TipoContato $objTipoContato){
		/*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM tipocontato WHERE descricao like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objTipoContato->getEmpresa() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objTipoContato = new TipoContato($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaTipoContato, $this->objTipoContato);
		}
	
		return $this->listaTipoContato;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM tipocontato limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM tipocontato";
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