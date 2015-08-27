<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/enderecopf/EnderecoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/enderecopf/EnderecoPFDAO.php';

class EnderecoPFControl{
	protected $con;
	protected $objEnderecoPF;
	protected $objEnderecoPFDAO;
	
	function __construct(EnderecoPF $objEnderecoPF=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objEnderecoPFDAO = new EnderecoPFDAO($this->con);
		$this->objContatoPF = $objEnderecoPF;
	}
	
	function cadastrar(){
		return $this->objEnderecoPFDAO->cadastrar($this->objContatoPF);
	}
	
	function atualizar(){
		return $this->objEnderecoPFDAO->atualizar($this->objContatoPF);
	}
	function deletar(){
		return $this->objEnderecoPFDAO->deletar($this->objContatoPF);
	}
	function buscarPorId(){
		return $this->objEnderecoPFDAO->buscarPorId($this->objContatoPF);
	}
	function listarTodos(){
		return $this->objEnderecoPFDAO->listarTodos($this->objContatoPF);
	}
	function listarPaginado($start, $limit){
		return $this->objEnderecoPFDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objEnderecoPFDAO->qtdTotal();
	}
}

?>