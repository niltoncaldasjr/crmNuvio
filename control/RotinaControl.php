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
		$this->objRotinaDAO->cadastrar($this->objRotina);
	}
	
	function atualizar(){
		$this->objRotinaDAO->atualizar($this->objRotina);
	}
	function deletar(){
		$this->objRotinaDAO->deletar($this->objRotina);
	}
	function buscarPorID(){
		$this->objRotinaDAO->buscarPorID($this->objRotina);
	}
	function listarTodos(){
		$this->objRotinaDAO->listarTodos($this->objRotina);
	}
	function listarPorNome(){
		$this->objRotinaDAO->listarPorNome($this->objRotina);
	}
	
}

?>