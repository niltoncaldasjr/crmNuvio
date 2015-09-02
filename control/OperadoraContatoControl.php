<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/operadoracontato/OperadoraContatoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/operadoracontato/OperadoraContato.php';

class OperadoraContatoControl{
	protected $con;
	protected $objOperadoraContato;
	protected $objOperadoraContatoDAO;
	
	function __construct(OperadoraContato $objOperadoraContato=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objOperadoraContatoDAO = new OperadoraContatoDAO($this->con);
		$this->objOperadoraContato = $objOperadoraContato;
	}
	
	function cadastrar(){
		return $this->objOperadoraContatoDAO->cadastrar($this->objOperadoraContato);
	}
	
	function atualizar(){
		return $this->objOperadoraContatoDAO->atualizar($this->objOperadoraContato);
	}
	function deletar(){
		return $this->objOperadoraContatoDAO->deletar($this->objOperadoraContato);
	}
	function buscarPorID(){
		return $this->objOperadoraContatoDAO->buscarPorID($this->objOperadoraContato);
	}
	function listarTodos(){
		return $this->objOperadoraContatoDAO->listarTodos($this->objOperadoraContato);
	}
	function listarPorNome(){
		return $this->objOperadoraContatoDAO->listarPorNome($this->objOperadoraContato);
	}
	function listarPaginado($start, $limit){
		return $this->objOperadoraContatoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objOperadoraContatoDAO->qtdTotal();
	}
}

?>