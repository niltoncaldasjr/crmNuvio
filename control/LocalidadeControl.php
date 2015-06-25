<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/LocalidadeDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/Localidade.php';

class LocalidadeControl{
	protected $con;
	protected $objLocalidade;
	protected $objLocalidadeDAO;

	function __construct(Localidade $objLocalidade=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objLocalidadeDAO = new LocalidadeDAO($this->con);
		$this->objLocalidade = $objLocalidade;
	}

	function cadastrar(){
		return $this->objLocalidadeDAO->cadastrar($this->objLocalidade);
	}

	function atualizar(){
		return $this->objLocalidadeDAO->atualizar($this->objLocalidade);
	}
	function deletar(){
		return $this->objLocalidadeDAO->deletar($this->objLocalidade);
	}
	function buscarPorID(){
		return $this->objLocalidadeDAO->buscarPorId($this->objLocalidade);
	}
	function listarTodos(){
		return $this->objLocalidadeDAO->listarTodos($this->objLocalidade);
	}
	
}

?>