<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'util/Conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/EmpresaDAO.php';

class EmpresaControl{
	protected $con;
	protected $o_empresa;
	protected $o_empresaDAO;

	function __construct(Empresa $o_empresa= null){
		$this->con = Conexao::getInstance()->getConexao();
		$this->o_empresaDAO = new EmpresaDAO($this->con);
		$this->o_empresa = $o_empresa;
	}

	function cadastrar(){
		$id = $this->o_empresaDAO->cadastrar($this->o_empresa);
		return $id;  // para desfazer o id de retorno
	}

	function atualizar(){
		$this->o_empresaDAO->atualizar($this->o_empresa);
	}

	function deletar(){
		$this->o_empresaDAO->deletar($this->o_empresa);
	}

	function buscarPorId(){
		return $this->o_empresaDAO->buscarPorId($this->o_empresa);
	}

	function listarPorPessoa(){
		return $this->o_empresaDAO->listarPorNome($this->o_empresa);
	}
	function listarDadosCompletos(){
		return $this->o_empresaDAO->buscarTodosOsDados($this->o_empresa);
	}
	
	function listarTodos(){
		return $this->o_empresaDAO->listarTodos();
	}

}
?>