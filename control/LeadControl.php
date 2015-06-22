<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/LeadDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';

class LeadControl{
	protected $con;
	protected $objLead;
	protected $objLeadDAO;
	
	function __construct(Lead $objLead=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objLeadDAO = new LeadDAO($this->con);
		$this->objLead = $objLead;
	}
	
	function cadastrar(){
		return $this->objLeadDAO->cadastrar($this->objLead);
	}
	
	function atualizar(){
		return $this->objLeadDAO->atualizar($this->objLead);
	}
	function deletar(){
		return $this->objLeadDAO->deletar($this->objLead);
	}
	function buscarPorID(){
		return $this->objLeadDAO->buscarPorID($this->objLead);
	}
	function listarTodos(){
		return $this->objLeadDAO->listarTodos($this->objLead);
	}
	function listarPorNome(){
		return $this->objLeadDAO->listarPorNome($this->objLead);
	}
	
}

?>