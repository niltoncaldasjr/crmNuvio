<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/banco/Banco.php'; //import
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/empresa/Empresa.php'; //import
class ContaBanco implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $agencia;
	private $digitoAgencia;
	private $numeroConta;
	private $digitoConta;
	private $numeroCarteira;
	private $numeroConvenio;
	private $nomeContato;
	private $telefoneContato;
	private $datacadastro;
	private $dataedicao;
	private $objBanco;
	private $objEmpresa;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id					=	Null,
		$agencia			=	NULL,
		$digitoAgencia		=	NULL,
		$numeroConta		=	NULL,
		$digitoConta		=	NULL,
		$numeroCarteira		=	NULL,
		$numeroConvenio		=	NULL,
		$nomeContato		=	NULL,
		$telefoneContato	=	NULL,
		$datacadastro		=	NULL,
		$dataedicao			=	NULL,
		Banco $objBanco		=	NULL,
		Empresa $objEmpresa	=	NULL
	)
	{
		$this->id				=	$id;
		$this->agencia 			= 	$agencia;
		$this->digitoAgencia	=	$digitoAgencia;
		$this->numeroConta		=	$numeroConta;
		$this->digitoConta 		=	$digitoConta;
		$this->numeroCarteira 	=	$numeroCarteira;
		$this->numeroConvenio 	=	$numeroConvenio;
		$this->nomeContato 		=	$nomeContato;
		$this->telefoneContato 	=	$telefoneContato;
		$this->datacadastro 	=	$datacadastro;
		$this->dataedicao 		= 	$dataedicao;
		$this->objBanco 		=	$objBanco;
		$this->objEmpresa  		=	$objEmpresa;
	}
	
	/*-- Getters Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getAgencia() {
		return $this->agencia;
	}
	public function setAgencia($agencia) {
		$this->agencia = $agencia;
		return $this;
	}
	public function getDigitoAgencia() {
		return $this->digitoAgencia;
	}
	public function setdigitoAgencia($digitoAgencia) {
		$this->digitoAgencia = $digitoAgencia;
		return $this;
	}
	public function getNumeroConta() {
		return $this->numeroConta;
	}
	public function setNumeroConta($numeroConta) {
		$this->numeroConta = $numeroConta;
		return $this;
	}
	public function getDigitoConta() {
		return $this->digitoConta;
	}
	public function setDigitoConta($digitoConta) {
		$this->digitoConta = $digitoConta;
		return $this;
	}
	public function getNumeroCarteira() {
		return $this->numeroCarteira;
	}
	public function setNumeroCarteira($numeroCarteira) {
		$this->numeroCarteira = $numeroCarteira;
		return $this;
	}
	public function getNumeroConvenio() {
		return $this->numeroConvenio;
	}
	public function setNumeroConvenio($numeroConvenio) {
		$this->numeroConvenio = $numeroConvenio;
		return $this;
	}
	public function getNomeContato() {
		return $this->nomeContato;
	}
	public function setNomeContato($nomeContato) {
		$this->nomeContato = $nomeContato;
		return $this;
	}
	public function getTelefoneContato() {
		return $this->telefoneContato;
	}
	public function setTelefoneContato($telefoneContato) {
		$this->telefoneContato = $telefoneContato;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	public function getObjBanco() {
		return $this->objBanco;
	}
	public function setObjBanco($objBanco) {
		$this->objBanco = $objBanco;
		return $this;
	}
	public function getObjEmpresa() {
		return $this->objEmpresa;
	}
	public function setObjEmpresa($objEmpresa) {
		$this->objEmpresa = $objEmpresa;
		return $this;
	}
	
	/*-- ToString --*/
	public function __toString(){
		return sprintf("ContaBanco: [ ID: %d, Agencia: %s, DigitoAgencia: %s, NumeroConta: %s, DigitoConta: %s, NumeroCarteira: %s, NumeroConvenio: %s, NomeContato: %s, TelefoneContato: %s, DataCadastro: %s, DataEdicao: %s , Banco: %s, Empresa: %s ]",
				$this->id, 
				$this->agencia, 
				$this->digitoAgencia, 
				$this->numeroConta, 
				$this->digitoConta, 
				$this->numeroCarteira, 
				$this->numeroConvenio, 
				$this->nomeContato,
				$this->telefoneContato, 
				$this->datacadastro, 
				$this->dataedicao,
				$this->objBanco->getNome(), 
				$this->objEmpresa->getNomeReduzido());
	}
	
	/*-- Json --*/
	public function jsonSerialize() {
		return [
			'id' 				=>	$this->id,
			'agencia' 			=> 	$this->agencia,
			'digitoAgencia' 	=>	$this->digitoAgencia,
			'numeroConta' 		=>	$this->numeroConta,
			'digitoConta' 		=>	$this->digitoConta,
			'numeroCarteira' 	=> 	$this->numeroCarteira,
			'numeroConvenio' 	=> 	$this->numeroConvenio,
			'nomeContato' 		=> 	$this->nomeContato,
			'telefoneContato' 	=>	$this->telefoneContato,
			'datacadastro' 		=>	$this->datacadastro,
			'dataedicao' 		=>	$this->dataedicao,
			'idbanco' 			=>	$this->objBanco->jsonSerialize(),
			'idempresa' 		=>	$this->objEmpresa->jsonSerialize()
		];
	}
	
}
?>