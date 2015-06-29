<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/perfilusuario/PerfilUsuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/perfil/Perfil.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'control/PerfilControl.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/usuario/Usuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'control/UsuarioControl.php';

class PerfilUsuarioDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objPerfilUsuario;
	private $listaPerfilUsuario = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(PerfilUsuario $objPerfilUsuario){
		$this->sql = sprintf("INSERT INTO perfilusuario (idperfil, idusuario) VALUES(%d, %d)",
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getObjPerfil()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getObjUsuario()->getId() ) );
	
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		return mysqli_insert_id ( $this->con );		
	}
	//*******************************************************************************************
	/*-- Metodo Atualizar --*/
	function atualizar(PerfilUsuario $objPerfilUsuario){
		$this->sql = sprintf("UPDATE perfilusuario SET idusuario = %d, idperfil = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getObjPerfil()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getId() ));
		
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objPerfilUsuario = $objPerfilUsuario;
	}
	
	/*-- Deletar --*/
	function deletar(PerfilUsuario $objPerfilUsuario){
		$this->sql = sprintf("DELETE FROM perfilusuario WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getId() ));
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objPerfilUsuario;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(PerfilUsuario $objPerfilUsuario){
		$this->sql = sprintf("SELECT * FROM perfilusuario WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilUsuario->getId() ));
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPerfil = new Perfil();
			$objPerfil->setId($row->idperfil);
			$objPerfilControl = new PerfilControl($objPerfil);
			$objPerfil = $objPerfilControl->buscarPorId();
			
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objPerfilUsuario = new PerfilUsuario($row->id, $row->datacadastro, $objPerfil, $objUsuario );
		}
	
		return $this->objPerfilUsuario;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(){
		$this->sql = "SELECT * FROM perfilusuario";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			
			$objPerfil = new Perfil();
			$objPerfil->setId($row->idperfil);
			$objPerfilControl = new PerfilControl($objPerfil);
			$objPerfil = $objPerfilControl->buscarPorId();
			
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objPerfilUsuario = new PerfilUsuario($row->id, $row->datacadastro, $objPerfil, $objUsuario );
	
			$this->listaPerfilUsuario [] = $this->objPerfilUsuario;
		}
	
		return $this->listaPerfilUsuario;
	}
	
		
	}
	