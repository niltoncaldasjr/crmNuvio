<?php
class TipoEnderecoDAO{
	/*-- propriedades --*/
	private $con;
	private $sql;
	private $objTipoEndereco;
	private $listaTipoEndereco = array();
	
	function __construct($con)
	{
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(TipoEndereco $objTipoEndereco){
		$this->sql = sprintf("INSERT INTO tipoendereco (descricao) VALUES('%s')",
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getDescricao() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(TipoEndereco $objTipoEndereco){
		$this->sql = sprintf("UPDATE tipoendereco SET descricao= '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objTipoEndereco;
	}
	
	/*-- Deletar --*/
	function deletar(TipoEndereco $objTipoEndereco){
		$this->sql = sprintf("DELETE FROM tipoendereco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objTipoEndereco;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(TipoEndereco $objTipoEndereco){
		$this->sql = sprintf("SELECT * FROM tipoendereco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objTipoEndereco = new TipoEndereco($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
		}
	
		return $this->objTipoEndereco;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(TipoEndereco $objTipoEndereco){
		$this->sql = "SELECT * FROM tipoendereco";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objTipoEndereco = new TipoEndereco($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaTipoEndereco, $this->objTipoEndereco);
		}
	
		return $this->listaTipoEndereco;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(TipoEndereco $objTipoEndereco){
		/*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM tipoendereco WHERE descricao like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objTipoEndereco->getEmpresa() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
	
			$this->objTipoEndereco = new TipoEndereco($row->id, $row->descricao, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaTipoEndereco, $this->objTipoEndereco);
		}
	
		return $this->listaTipoEndereco;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM tipoendereco limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM tipoendereco";
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