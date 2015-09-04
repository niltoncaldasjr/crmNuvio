<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/TipoEnderecoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/tipoendereco/TipoEndereco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/pessoafisica/PessoaFisica.php';

class EnderecoPF implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objtipoendereco;
	private $logradouro;
	private $numero;
	private $complemento;
	private $bairro;
	private $cep;
	private $objlocalidade;
	private $objpessoafisica;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 							= NULL,
		TipoEndereco $objtipoendereco 	= NULL,
		$logradouro 					= NULL,
		$numero 						= NULL,
		$complemento 					= NULL,
		$bairro 						= NULL,
		$cep 							= NULL,
		Localidade $objlocalidade		= NULL,
		PessoaFisica $objpesoafisica 	= NULL,
		$datacadastro 					= NULL,
		$dataedicao 					= NULL
	)
	{
		$this->id 				= $id;
		$this->objtipoendereco	= $objtipoendereco;
		$this->logradouro		= $logradouro;
		$this->numero 			= $numero;
		$this->complemento 		= $complemento;
		$this->bairro			= $bairro;
		$this->cep 				= $cep;
		$this->objlocalidade	= $objlocalidade;
		$this->objpessoafisica 	= $objpesoafisica;
		$this->datacadastro		= $datacadastro;
		$this->dataedicao 		= $dataedicao;
		
	}
	
	/*-- Getter and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjtipoendereco() {
		return $this->objtipoendereco;
	}
	public function setObjtipoendereco($objtipoendereco) {
		$this->objtipoendereco = $objtipoendereco;
		return $this;
	}
	public function getLogradouro() {
		return $this->logradouro;
	}
	public function setLogradouro($logradouro) {
		$this->logradouro = $logradouro;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getComplemento() {
		return $this->complemento;
	}
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
		return $this;
	}
	public function getBairro() {
		return $this->bairro;
	}
	public function setBairro($bairro) {
		$this->bairro = $bairro;
		return $this;
	}
	public function getCep() {
		return $this->cep;
	}
	public function setCep($cep) {
		$this->cep = $cep;
		return $this;
	}
	public function getObjlocalidade() {
		return $this->objlocalidade;
	}
	public function setObjlocalidade($objlocalidade) {
		$this->objlocalidade = $objlocalidade;
		return $this;
	}
	public function getObjpessoafisica() {
		return $this->objpessoafisica;
	}
	public function setObjpessoafisica($objpessoafisica) {
		$this->objpessoafisica = $objpessoafisica;
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
	
	/*-- Json --*/
	public function jsonSerialize(){
		return [
			'id' 				=> $this->id,
			'idtipoendereco'	=> $this->objtipoendereco->jsonSerialize(),
			'logradouro'		=> $this->logradouro,
			'numero'			=> $this->numero,
			'complemento'		=> $this->complemento,
			'bairro'			=> $this->bairro,
			'cep'				=> $this->cep,
			'idlocalidade'		=> $this->objlocalidade->jsonSerialize(),
			'idpessoafisica'	=> $this->objpessoafisica->jsonSerialize(),
			'datacadastro'		=> $this->datacadastro,
			'dataedicao'		=> $this->dataedicao
		];
	}
	
	
}

?>