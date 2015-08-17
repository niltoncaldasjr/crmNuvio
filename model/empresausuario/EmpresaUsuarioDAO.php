<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/empresausuario/EmpresaUsuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/empresa/Empresa.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'control/EmpresaControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/usuario/Usuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'control/UsuarioControl.php';

class EmpresaUsuarioDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objEmpresaUsuario;
	private $listaEmpresaUsuario = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = sprintf("INSERT INTO empresausuario (idempresa, idusuario) VALUES(%d, %d)",
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjEmpresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjUsuario()->getId() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		return mysqli_insert_id ( $this->con );		
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = sprintf("UPDATE empresausuario SET idempresa = %d, idusuario = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjEmpresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjUsuario()->getId() ), 
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getId() ));
		
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
	}
	
	/*-- Deletar --*/
	function deletar(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = sprintf("DELETE FROM empresausuario WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getId() ));
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objEmpresaUsuario;
	}

	/*-- Deletar Por Usuario --*/
	function deletarPorEmpresaUsuario(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = sprintf("DELETE FROM empresausuario WHERE idempresa = %d AND idusuario = %d",
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjEmpresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getObjUsuario()->getId() ));
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objEmpresaUsuario;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = sprintf("SELECT * FROM empresausuario WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEmpresaUsuario->getId() ));
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorID();
				
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objEmpresaUsuario = new EmpresaUsuario($row->id, $objEmpresa, $objUsuario, $row->datacadastro);
		}
	
		return $this->objEmpresaUsuario;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(EmpresaUsuario $objEmpresaUsuario){
		$this->sql = "SELECT * FROM empresausuario";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorID();
				
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objEmpresaUsuario = new EmpresaUsuario($row->id, $objEmpresa, $objUsuario, $row->datacadastro);
	
			$this->listaEmpresaUsuario [] = $this->objEmpresaUsuario;
		}
	
		return $this->listaEmpresaUsuario;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM empresausuario limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM empresausuario";
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