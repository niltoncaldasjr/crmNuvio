<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuariorotina/UsuarioRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';

class UsuarioRotinaDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objUsuarioRotina;
	private $listaUsuarioRotina = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(UsuarioRotina $objUsuarioRotina){
		$this->sql = sprintf("INSERT INTO usuariorotina (idrotina, idusuario, consulta, incluir, alterar, excluir) VALUES(%d, %d, %d, %d, %d, %d)",
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjRotina()->getId() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getConsulta() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getIncluir() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getAlterar() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getExcluir() ));
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(UsuarioRotina $objUsuarioRotina){
		$this->sql = sprintf("UPDATE usuariorotina SET idrotina = %d, idusuario = %d, consulta = %d, incluir = %d, alterar = %d, excluir = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjRotina()->getId() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getConsulta() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getIncluir() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getAlterar() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getExcluir() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objUsuarioRotina = $objUsuarioRotina;
	}
	
	/*-- Deletar --*/
	function deletar(UsuarioRotina $objUsuarioRotina){
		$this->sql = sprintf("DELETE FROM usuariorotina WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objUsuarioRotina = $objUsuarioRotina;
	}
	
	function deletarRotinasDoUsuario(UsuarioRotina $objUsuarioRotina){
		$this->sql = sprintf("DELETE FROM usuariorotina WHERE idusuario = %d",
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjUsuario()->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objUsuarioRotina = $objUsuarioRotina;
	}
	
	function deletarPorUsuarioRotina(UsuarioRotina $objUsuarioRotina){
		$this->sql = sprintf("DELETE FROM usuariorotina WHERE idrotina = %d AND idusuario = %d",
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjRotina()->getId() ),
				mysqli_real_escape_string( $this->con, $objUsuarioRotina->getObjUsuario()->getId() ));
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $objUsuarioRotina;
	}
	
	
	/*-- Listar Todos --*/
	function listarTodos(UsuarioRotina $objUsuarioRotina){
		$this->sql = "SELECT * FROM usuariorotina";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objRotina = new Rotina();
			$objRotina->setId($row->idrotina);
			$objRotinaControl = new RotinaControl($objRotina);
			$objRotina = $objRotinaControl->buscarPorID();
				
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idperfil);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$this->objPerfilRotina = new PerfilRotina($row->id, $row->datacadastro, $objRotina, $objUsuario);
				
			array_push($this->listaPerfilRotina, $this->objUsuarioRotina);
		}
		
		return $this->listaUsuarioRotina;
	}
	
			
}
?>