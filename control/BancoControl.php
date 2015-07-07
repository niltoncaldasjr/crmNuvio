<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/banco/BancoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/banco/Banco.php';

class BancoControl{
	protected $con;
	protected $objBanco;
	protected $objBancoDAO;
	
	function __construct(Banco $objBanco=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objBancoDAO = new BancoDAO($this->con);
		$this->objBanco = $objBanco;
	}
	
	function cadastrar(){
		return $this->objBancoDAO->cadastrar($this->objBanco);
	}
	
	function atualizar(){
		return $this->objBancoDAO->atualizar($this->objBanco);
	}
	function deletar(){
		return $this->objBancoDAO->deletar($this->objBanco);
	}
	function buscarPorID(){
		return $this->objBancoDAO->buscarPorID($this->objBanco);
	}
	function listarTodos(){
		return $this->objBancoDAO->listarTodos($this->objBanco);
	}
	function listarPorNome(){
		return $this->objBancoDAO->listarPorNome($this->objBanco);
	}
	function listarPaginado($start, $limit){
		return $this->objBancoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objBancoDAO->qtdTotal();
	}
}

?>