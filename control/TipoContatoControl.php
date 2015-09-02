<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/tipocontato/TipoContatoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/tipocontato/TipoContato.php';

class TipoContatoControl{
	protected $con;
	protected $objTipoContato;
	protected $objTipoContatoDAO;
	
	function __construct(TipoContato $objTipoContato=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objTipoContatoDAO = new TipoContatoDAO($this->con);
		$this->objTipoContato = $objTipoContato;
	}
	
	function cadastrar(){
		return $this->objTipoContatoDAO->cadastrar($this->objTipoContato);
	}
	
	function atualizar(){
		return $this->objTipoContatoDAO->atualizar($this->objTipoContato);
	}
	function deletar(){
		return $this->objTipoContatoDAO->deletar($this->objTipoContato);
	}
	function buscarPorID(){
		return $this->objTipoContatoDAO->buscarPorID($this->objTipoContato);
	}
	function listarTodos(){
		return $this->objTipoContatoDAO->listarTodos($this->objTipoContato);
	}
	function listarPorNome(){
		return $this->objTipoContatoDAO->listarPorNome($this->objTipoContato);
	}
	function listarPaginado($start, $limit){
		return $this->objTipoContatoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objTipoContatoDAO->qtdTotal();
	}
}

?>