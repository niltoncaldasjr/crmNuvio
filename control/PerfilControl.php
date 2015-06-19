<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "crmNuvio/" . 'model/perfil/PerfilDAO.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . "crmNuvio/" . 'model/perfil/Perfil.php';

class PerfilControl{
	protected $con;
	protected $o_perfil;
	protected $o_perfilDAO;

	function __construct(Perfil $o_perfil= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_perfilDAO = new PerfilDAO;
		$this->o_perfil = $o_perfil;
	}

	function cadastrar(){
		$id = $this-> $this->o ->cadastrar($this->o_perfil);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_perfilDAO->atualizar($this->o_perfil);
	}

	function deletar(){
		$this->o_perfilDAO->deletar($this->o_perfil);
	}

	function buscarPorId(){
		return $this->o_perfilDAO->buscarPorId($this->o_perfil);
	}

	function listarPorPessoa(){
		return $this->o_perfilDAO->listarPorPessoa($this->o_perfil);
	}
	
	function listarTodos(){
		return $this->o_perfilDAO->listarTodos();
	}

}
?>