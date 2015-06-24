<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contabanco/ContaBancoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contabanco/ContaBanco.php';

class ContaBancoControl{
	protected $con;
	protected $objContaBanco;
	protected $objContaBancoDAO;

	function __construct(ContaBanco $objContaBanco=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objContaBancoDAO = new ContaBancoDAO($this->con);
		$this->objContaBanco = $objContaBanco;
	}

	function cadastrar(){
		return $this->objContaBancoDAO->cadastrar($this->objContaBanco);
	}

	function atualizar(){
		return $this->objContaBancoDAO->atualizar($this->objContaBanco);
	}
	function deletar(){
		return $this->objContaBancoDAO->deletar($this->objContaBanco);
	}
	function buscarPorID(){
		return $this->objContaBancoDAO->buscarPorID($this->objContaBanco);
	}
	function listarTodos(){
		return $this->objContaBancoDAO->listarTodos($this->objContaBanco);
	}
	
}

?>