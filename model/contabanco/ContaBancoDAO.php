<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contabanco/ContaBanco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/banco/Banco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/BancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';

class ContaBancoDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objContaBanco;
	private $listaContaBanco = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(ContaBanco $objContaBanco){
		$this->sql = sprintf("INSERT INTO contabanco (agencia, digitoAgencia, numeroConta, digitoConta, numeroCarteira, numeroConvenio, nomeContato, telefoneContato, idbanco, idempresa) 
				VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, %d)",
				mysqli_real_escape_string( $this->con, $objContaBanco->getAgencia() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getdigitoAgencia() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroConta() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getDigitoConta() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroCarteira() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroConvenio() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNomeContato() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getTelefoneContato() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getObjBanco()->getId() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getObjEmpresa()->getId() ) );
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(ContaBanco $objContaBanco){
		$this->sql = sprintf("UPDATE contabanco SET agencia = '%s', digitoAgencia = '%s', numeroConta ='%s', digitoConta = '%s', numeroCarteira = '%s', numeroConvenio = '%s', nomeContato = '%s', telefoneContato = '%s', dataedicao = '%s', idbanco = %d, idempresa = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContaBanco->getAgencia() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getDigitoAgencia() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroConta() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getDigitoConta() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroCarteira() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNumeroConvenio() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getNomeContato() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getTelefoneContato() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getObjBanco()->getId() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getObjEmpresa()->getId() ),
				mysqli_real_escape_string( $this->con, $objContaBanco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContaBanco = $objContaBanco;
	}
	
	/*-- Deletar --*/
	function deletar(ContaBanco $objContaBanco){
		$this->sql = sprintf("DELETE FROM contabanco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContaBanco->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContaBanco = $objContaBanco;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(ContaBanco $objContaBanco){
		$this->sql = sprintf("SELECT * FROM contabanco WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContaBanco->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objBanco = new Banco();
			$objBanco->setId($row->idbanco);
			$objBancoControl = new BancoControl($objBanco);
			$objBanco = $objBancoControl->buscarPorID();
			
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
			
			$this->objContaBanco = new ContaBanco($row->id, $row->agencia, $row->digitoAgencia, $row->numeroConta, $row->digitoConta, $row->numeroCarteira, $row->numeroConvenio, $row->nomeContato, $row->telefoneContato, $row->datacadastro, $row->dataedicao, $objBanco, $objEmpresa); 
		}
		
		return $this->objContaBanco;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(ContaBanco $objContaBanco){
		$this->sql = "SELECT * FROM contabanco";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objBanco = new Banco();
			$objBanco->setId($row->idbanco);
			$objBancoControl = new BancoControl($objBanco);
			$objBanco = $objBancoControl->buscarPorID();
				
			$objEmpresa = new Empresa();
			$objEmpresa->setId($row->idempresa);
			$objEmpresaControl = new EmpresaControl($objEmpresa);
			$objEmpresa = $objEmpresaControl->buscarPorId();
				
			$this->objContaBanco = new ContaBanco($row->id, $row->agencia, $row->digitoAgencia, $row->numeroConta, $row->digitoConta, $row->numeroCarteira, $row->numeroConvenio, $row->nomeContato, $row->telefoneContato, $row->datacadastro, $row->dataedicao, $objBanco, $objEmpresa); 
				
			array_push($this->listaContaBanco, $this->objContaBanco);
		}
		
		return $this->listaContaBanco;
	}
	
			
}
?>