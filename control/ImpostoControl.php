<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/ImpostoDAO.php';

class ImpostoControl{
	protected $con;
	protected $o_imposto;
	protected $o_usuarioDAO;

	function __construct(Imposto $o_imposto= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_impostoDAO = new ImpostoDAO($this->con);
		$this->o_imposto = $o_imposto;
	}

	function cadastrar(){
		$id = $this->o_impostoDAO->cadastrar($this->o_imposto);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_impostoDAO->atualizar($this->o_imposto);
	}

	function deletar(){
		$this->o_impostoDAO->deletar($this->o_imposto);
	}

	function buscarPorId(){
		return $this->o_impostoDAO->buscarPorId($this->o_imposto);
	}

	function listarPorPessoa(){
		return $this->o_impostoDAO->listarPorNome($this->o_imposto);
	}
	
	function listarTodos(){
		return $this->o_impostoDAO->listarTodos();
	}

}
?>