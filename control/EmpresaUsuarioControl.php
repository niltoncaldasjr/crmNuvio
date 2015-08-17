<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresausuario/EmpresaUsuarioDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresausuario/EmpresaUsuario.php';

class EmpresaUsuarioControl{
	protected $con;
	protected $objEmpresaUsuario;
	protected $objEmpresaUsuarioDAO;

	function __construct(EmpresaUsuario $objEmpresaUsuario=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objEmpresaUsuarioDAO = new EmpresaUsuarioDAO($this->con);
		$this->objEmpresaUsuario = $objEmpresaUsuario;
	}

	function cadastrar(){
		return $this->objEmpresaUsuarioDAO->cadastrar($this->objEmpresaUsuario);
	}

	function atualizar(){
		return $this->objEmpresaUsuarioDAO->atualizar($this->objEmpresaUsuario);
	}
	function deletar(){
		return $this->objEmpresaUsuarioDAO->deletar($this->objEmpresaUsuario);
	}
	function deletarPorEmpresaUsuario(){
		return $this->objEmpresaUsuarioDAO->deletarPorEmpresaUsuario($this->objEmpresaUsuario);
	}
	function buscarPorId(){
		return $this->objEmpresaUsuarioDAO->buscarPorId($this->objEmpresaUsuario);
	}
	function listarTodos(){
		return $this->objEmpresaUsuarioDAO->listarTodos($this->objEmpresaUsuario);
	}	
	function listarPaginado($start, $limit){
		return $this->objEmpresaUsuarioDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objEmpresaUsuarioDAO->qtdTotal();
	}
}
