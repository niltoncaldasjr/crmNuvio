<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/RotinaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';

class RotinaControl{
	protected $con;
	protected $objRotina;
	protected $objRotinaDAO;
	
	function __construct(Rotina $objRotina=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objRotinaDAO = new RotinaDAO($this->con);
		$this->objRotina = $objRotina;
	}
	
	function cadastrar(){
		return $this->objRotinaDAO->cadastrar($this->objRotina);
	}
	
	function atualizar(){
		return $this->objRotinaDAO->atualizar($this->objRotina);
	}
	function deletar(){
		return $this->objRotinaDAO->deletar($this->objRotina);
	}
	function buscarPorId(){
		return $this->objRotinaDAO->buscarPorId($this->objRotina);
	}
	function listarTodos(){
		return $this->objRotinaDAO->listarTodos($this->objRotina);
	}
	function listarPorNome(){
		return $this->objRotinaDAO->listarPorNome($this->objRotina);
	}
	function listarPaginado($start, $limit){
		return $this->objRotinaDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objRotinaDAO->qtdTotal();
	}
}

?>