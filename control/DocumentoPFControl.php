<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/documentopf/DocumentoPFDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/documentopf/DocumentoPF.php';

class ContatoLeadControl{
	protected $con;
	protected $objDocumentoPF;
	protected $objDocumentoPFDAO;
	
	function __construct(ContatoLead $objDocumentoPF=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objDocumentoPFDAO = new ContatoLeadDAO($this->con);
		$this->objDocumentoPF = $objDocumentoPF;
	}
	
	function cadastrar(){
		return $this->objDocumentoPFDAO->cadastrar($this->objDocumentoPF);
	}
	
	function atualizar(){
		return $this->objDocumentoPFDAO->atualizar($this->objDocumentoPF);
	}
	function deletar(){
		return $this->objDocumentoPFDAO->deletar($this->objDocumentoPF);
	}
	function buscarPorId(){
		return $this->objDocumentoPFDAO->buscarPorId($this->objDocumentoPF);
	}
	function listarTodos(){
		return $this->objDocumentoPFDAO->listarTodos($this->objDocumentoPF);
	}
	function listarPaginado($start, $limit){
		return $this->objDocumentoPFDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objDocumentoPFDAO->qtdTotal();
	}
}

?>