<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilusuario/PerfilUsuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilusuario/PerfilUsuario.php';

class PerfilUsuarioControl{
	protected $con;
	protected $objPerfilUsuario;
	protected $objPerfilUsuarioDAO;

	function __construct(PerfilUsuario $objPerfilUsuario=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objPerfilUsuarioDAO = new PerfilUsuarioDAO($this->con);
		$this->objPerfilUsuario = $objPerfilUsuario;
	}

	function cadastrar(){
		return $this->objPerfilUsuarioDAO->cadastrar($this->objPerfilUsuario);
	}

	function atualizar(){
		return $this->objPerfilUsuarioDAO->atualizar($this->objPerfilUsuario);
	}
	function deletar(){
		return $this->objPerfilUsuarioDAO->deletar($this->objPerfilUsuario);
	}
	function buscarPorId(){
		return $this->objPerfilUsuarioDAO->buscarPorId($this->objPerfilUsuario);
	}
	function listarTodos(){
		return $this->objPerfilUsuarioDAO->listarTodos();
	}	
}
