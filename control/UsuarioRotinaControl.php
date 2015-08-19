<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuariorotina/UsuarioRotinaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuariorotina/UsuarioRotina.php';

class UsuarioRotinaControl{
	protected $con;
	protected $objUsuarioRotina;
	protected $objUsuarioRotinaDAO;

	function __construct(UsuarioRotina $objUsuarioRotina=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objUsuarioRotinaDAO = new UsuarioRotinaDAO($this->con);
		$this->objUsuarioRotina = $objUsuarioRotina;
	}

	function cadastrar(){
		return $this->objUsuarioRotinaDAO->cadastrar($this->objUsuarioRotina);
	}

	function atualizar(){
		return $this->objUsuarioRotinaDAO->atualizar($this->objUsuarioRotina);
	}
	function deletar(){
		return $this->objUsuarioRotinaDAO->deletar($this->objUsuarioRotina);
	}
	function deletarRotinasDoUsuario(){
		return $this->objUsuarioRotinaDAO->deletar($this->objUsuarioRotina);
	}
	
	function buscarPorId(){
		return $this->objUsuarioRotinaDAO->buscarPorId($this->objUsuarioRotina);
	}
	function listarPorPerfil(){
		return $this->objUsuarioRotinaDAO->listarPorPerfil($this->objUsuarioRotina);
	}
	function listarTodos(){
		return $this->objUsuarioRotinaDAO->listarTodos($this->objUsuarioRotina);
	}
	function listarPaginado($start, $limit){
		return $this->objUsuarioRotinaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objUsuarioRotinaDAO->qtdTotal();
	}
	
}

?>