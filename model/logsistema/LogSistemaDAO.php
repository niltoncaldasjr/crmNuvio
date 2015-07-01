<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/LogSistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';

class LogSistemaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objLogSistema;
	private $listaLogSistema = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(LogSistema $objLogSistema){
		$this->sql = sprintf("INSERT INTO logsistema (ocorrencia, nivel, idusuario) 
				VALUES('%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objLogSistema->getOcorrencia() ),
				mysqli_real_escape_string( $this->con, $objLogSistema->getNivel() ),
				mysqli_real_escape_string( $this->con, $objLogSistema->getObjUsuario()->getId() ) );
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(LogSistema $objLogSistema){
		$this->sql = sprintf("UPDATE logsistema SET ocorrencia = '%s', nivel = '%s', idusuario = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLogSistema->getOcorrencia() ),
				mysqli_real_escape_string( $this->con, $objLogSistema->getNivel() ),
				mysqli_real_escape_string( $this->con, $objLogSistema->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objLogSistema->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLogSistema = $objLogSistema;
	}
	
	/*-- Deletar --*/
	function deletar(LogSistema $objLogSistema){
		$this->sql = sprintf("DELETE FROM logsistema WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLogSistema->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objLogSistema = $objLogSistema;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(LogSistema $objLogSistema){
		$this->sql = sprintf("SELECT * FROM logsistema WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objLogSistema->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$this->objLogSistema = new LogSistema($row->id, $row->ocorrencia, $row->nivel, $row->datacadastro, $objUsuario); 
		}
		
		return $this->objLogSistema;
	}
	
	/*-- Listar por Nível --*/
	function listarPorNivel(LogSistema $objLogSistema){
		$this->sql = sprintf("SELECT * FROM logsistema WHERE nivel = '%s' ",
				mysqli_real_escape_string( $this->con, $objLogSistema->getNivel() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
					
			$this->objLogSistema = new LogSistema($row->id, $row->ocorrencia, $row->nivel, $row->datacadastro, $objUsuario); 
				
			array_push($this->listaLogSistema, $this->objLogSistema);
		}
		
		return $this->listaLogSistema;
	}
	
	/*-- Buscar por Usuário --*/
	function listarPorUsuario(LogSistema $objLogSistema){
		$this->sql = sprintf("SELECT * FROM logsistema WHERE idusuario = %d ",
				mysqli_real_escape_string( $this->con, $objLogSistema->getObjUsuario()->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objLogSistema = new LogSistema($row->id, $row->ocorrencia, $row->nivel, $row->datacadastro, $objUsuario); 
				
			array_push($this->listaLogSistema, $this->objLogSistema);
		}
		
		return $this->listaLogSistema;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(LogSistema $objLogSistema){
		$this->sql = "SELECT * FROM logsistema";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objLogSistema = new LogSistema($row->id, $row->ocorrencia, $row->nivel, $row->datacadastro, $objUsuario); 
				
			array_push($this->listaLogSistema, $this->objLogSistema);
		}
		
		return $this->listaLogSistema;
	}
	
			
}
?>