<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/tipoendereco/TipoEnderecoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/tipoendereco/TipoEndereco.php';

class TipoEnderecoControl{
	protected $con;
	protected $objTipoEndereco;
	protected $objTipoEnderecoDAO;
	
	function __construct(TipoEndereco $objTipoEndereco=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objTipoEnderecoDAO = new TipoEnderecoDAO($this->con);
		$this->objTipoEndereco = $objTipoEndereco;
	}
	
	function cadastrar(){
		return $this->objTipoEnderecoDAO->cadastrar($this->objTipoEndereco);
	}
	
	function atualizar(){
		return $this->objTipoEnderecoDAO->atualizar($this->objTipoEndereco);
	}
	function deletar(){
		return $this->objTipoEnderecoDAO->deletar($this->objTipoEndereco);
	}
	function buscarPorID(){
		return $this->objTipoEnderecoDAO->buscarPorID($this->objTipoEndereco);
	}
	function listarTodos(){
		return $this->objTipoEnderecoDAO->listarTodos($this->objTipoEndereco);
	}
	function listarPorNome(){
		return $this->objTipoEnderecoDAO->listarPorNome($this->objTipoEndereco);
	}
	function listarPaginado($start, $limit){
		return $this->objTipoEnderecoDAO->listarPaginado($start, $limit);
	}
	function qtdTotal(){
		return $this->objTipoEnderecoDAO->qtdTotal();
	}
}

?>