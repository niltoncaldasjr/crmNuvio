<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pais/PaisDAO.php';

class PaisControl{
	protected $con;
	protected $o_pais;
	protected $o_paisDAO;

	function __construct(Pais $o_pais= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_paisDAO = new PaisDAO($this->con);
		$this->o_pais = $o_pais;
	}

	function cadastrar(){
		$id = $this->o_paisDAO->cadastrar($this->o_pais);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_paisDAO->atualizar($this->o_pais);
	}

	function deletar(){
		$this->o_paisDAO->deletar($this->o_pais);
	}

	function buscarPorId(){
		return $this->o_paisDAO->buscarPorId($this->o_pais);
	}

	function listarPorPessoa(){
		return $this->o_paisDAO->listarPorNome($this->o_pais);
	}
	
	function listarTodos(){
		return $this->o_paisDAO->listarTodos();
	}

}
?>