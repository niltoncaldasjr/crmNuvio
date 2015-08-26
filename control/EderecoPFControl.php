<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatopf/ContatoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatopf/ContatoPFDAO.php';

class ContatoLeadControl{
	protected $con;
	protected $objContatoPF;
	protected $objContatoPFDAO;
	
	function __construct(ContatoLead $objContatoPF=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objContatoPFDAO = new ContatoLeadDAO($this->con);
		$this->objContatoPF = $objContatoPF;
	}
	
	function cadastrar(){
		return $this->objContatoPFDAO->cadastrar($this->objContatoPF);
	}
	
	function atualizar(){
		return $this->objContatoPFDAO->atualizar($this->objContatoPF);
	}
	function deletar(){
		return $this->objContatoPFDAO->deletar($this->objContatoPF);
	}
	function buscarPorId(){
		return $this->objContatoPFDAO->buscarPorId($this->objContatoPF);
	}
	function listarTodos(){
		return $this->objContatoPFDAO->listarTodos($this->objContatoPF);
	}
	function listarPaginado($start, $limit){
		return $this->objContatoPFDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objContatoPFDAO->qtdTotal();
	}
}

?>