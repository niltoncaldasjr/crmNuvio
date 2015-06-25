<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatolead/ContatoLeadDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatolead/ContatoLead.php';

class ContatoLeadControl{
	protected $con;
	protected $objContatoLead;
	protected $objContatoLeadDAO;
	
	function __construct(ContatoLead $objContatoLead=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objContatoLeadDAO = new ContatoLeadDAO($this->con);
		$this->objContatoLead = $objContatoLead;
	}
	
	function cadastrar(){
		return $this->objContatoLeadDAO->cadastrar($this->objContatoLead);
	}
	
	function atualizar(){
		return $this->objContatoLeadDAO->atualizar($this->objContatoLead);
	}
	function deletar(){
		return $this->objContatoLeadDAO->deletar($this->objContatoLead);
	}
	function buscarPorId(){
		return $this->objContatoLeadDAO->buscarPorId($this->objContatoLead);
	}
	function listarTodos(){
		return $this->objContatoLeadDAO->listarTodos($this->objContatoLead);
	}
	function listarPorNome(){
		return $this->objContatoLeadDAO->listarPorNome($this->objContatoLead);
	}
	
}

?>