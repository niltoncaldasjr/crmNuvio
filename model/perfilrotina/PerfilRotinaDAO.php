<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';

class PerfilRotinaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objPerfilRotina;
	private $listaPerfilRotina = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(PerfilRotina $objPerfilRotina){
		$this->sql = sprintf("INSERT INTO perfilrotina (idrotina, idperfil) VALUES(%d, %d)",
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getObjRotina()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getObjPerfil()->getId() ) );
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(PerfilRotina $objPerfilRotina){
		$this->sql = sprintf("UPDATE perfilrotina SET idrotina = %d, idperfil = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getObjRotina()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getObjPerfil()->getId() ),
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objPerfilRotina = $objPerfilRotina;
	}
	
	/*-- Deletar --*/
	function deletar(PerfilRotina $objPerfilRotina){
		$this->sql = sprintf("DELETE FROM perfilrotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objPerfilRotina = $objPerfilRotina;
	}
	
	/*-- Buscar por ID --*/
	function listarPorPerfil(PerfilRotina $objPerfilRotina){
		$this->sql = sprintf("SELECT * FROM perfilrotina WHERE id_perfil = %d",
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getObjPerfil()->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objRotina = new Rotina();
			$objRotina->setId($row->idrotina);
			$objRotinaControl = new RotinaControl($objRotina);
			$objRotina = $objRotinaControl->buscarPorId();
			
			$objPerfil = new Perfil();
			$objPerfil->setId($row->idperfil);
			$objPerfilControl = new PerfilControl($objPerfil);
			$objPerfil = $objPerfilControl->buscarPorId();
			
			$this->objPerfilRotina = new PerfilRotina($row->id, $row->datacadastro, $objRotina, $objPerfil); 
		}
		
		return $this->objPerfilRotina;
	}
	
	/*-- Buscar por ID de Perfil --*/
	function buscarPorId(PerfilRotina $objPerfilRotina){
		$this->sql = sprintf("SELECT * FROM perfilrotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPerfilRotina->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objRotina = new Rotina();
			$objRotina->setId($row->idrotina);
			$objRotinaControl = new RotinaControl($objRotina);
			$objRotina = $objRotinaControl->buscarPorId();
				
			$objPerfil = new Perfil();
			$objPerfil->setId($row->idperfil);
			$objPerfilControl = new PerfilControl($objPerfil);
			$objPerfil = $objPerfilControl->buscarPorId();
				
			$this->objPerfilRotina = new PerfilRotina($row->id, $row->datacadastro, $objRotina, $objPerfil);
			
			array_push($this->listaPerfilRotina, $this->objPerfilRotina);
		}
	
		return $this->listaPerfilRotina;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(PerfilRotina $objPerfilRotina){
		$this->sql = "SELECT * FROM perfilrotina";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objRotina = new Rotina();
			$objRotina->setId($row->idrotina);
			$objRotinaControl = new RotinaControl($objRotina);
			$objRotina = $objRotinaControl->buscarPorID();
				
			$objPerfil = new Perfil();
			$objPerfil->setId($row->idperfil);
			$objPerfilControl = new PerfilControl($objPerfil);
			$objPerfil = $objPerfilControl->buscarPorId();
				
			$this->objPerfilRotina = new PerfilRotina($row->id, $row->datacadastro, $objRotina, $objPerfil);
				
			array_push($this->listaPerfilRotina, $this->objPerfilRotina);
		}
		
		return $this->listaPerfilRotina;
	}
	
			
}
?>