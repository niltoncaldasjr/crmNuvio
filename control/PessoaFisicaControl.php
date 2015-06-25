<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisicaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';

class PessoaFisicaControl{
	protected $con;
	protected $objPessoaFisica;
	protected $objPessoaFisicaDAO;
	
	function __construct(PessoaFisica $objPessoaFisica=null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->objPessoaFisicaDAO = new PessoaFisicaDAO($this->con);
		$this->objPessoaFisica = $objPessoaFisica;
	}
	
	function cadastrar(){
		return $this->objPessoaFisicaDAO->cadastrar($this->objPessoaFisica);
	}
	
	function atualizar(){
		return $this->objPessoaFisicaDAO->atualizar($this->objPessoaFisica);
	}
	function deletar(){
		return $this->objPessoaFisicaDAO->deletar($this->objPessoaFisica);
	}
	function buscarPorId(){
		return $this->objPessoaFisicaDAO->buscarPorId($this->objPessoaFisica);
	}
	function listarTodos(){
		return $this->objPessoaFisicaDAO->listarTodos($this->objPessoaFisica);
	}
	function listarPorNome(){
		return $this->objPessoaFisicaDAO->listarPorNome($this->objPessoaFisica);
	}
	
}

?>