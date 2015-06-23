<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotinaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotina.php';

class PerfilRotinaControl{
	protected $con;
	protected $objPerfilRotina;
	protected $objPerfilRotinaDAO;

	function __construct(PerfilRotina $objPerfilRotina=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objPerfilRotinaDAO = new PerfilRotinaDAO($this->con);
		$this->objPerfilRotina = $objPerfilRotina;
	}

	function cadastrar(){
		return $this->objPerfilRotinaDAO->cadastrar($this->objPerfilRotina);
	}

	function atualizar(){
		return $this->objPerfilRotinaDAO->atualizar($this->objPerfilRotina);
	}
	function deletar(){
		return $this->objPerfilRotinaDAO->deletar($this->objPerfilRotina);
	}
	function buscarPorID(){
		return $this->objPerfilRotinaDAO->buscarPorID($this->objPerfilRotina);
	}
	function listarTodos(){
		return $this->objPerfilRotinaDAO->listarTodos($this->objPerfilRotina);
	}
	
}

?>