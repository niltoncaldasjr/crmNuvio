<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/tipocontato/TipoContato.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/operadoracontato/OperadoraContato.php';

class ContatoPF implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $objtipocontato;
	private $objoperadoracontato;
	private $contato;
	private $objpessoafisica;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 									= NULL,
		TipoContato $objtipocontato				= NULL,
		OperadoraContato $objoperadoracontato	= NULL,
		$contato 								= NULL,
		PessoaFisica $objpessoafisica 			= NULL,
		$datacadastro							= NULL,
		$dataedicao 							= NULL
	)
	{
		$this->id 					= $id;
		$this->objtipocontato 		= $objtipocontato;
		$this->objoperadoracontato	= $objoperadoracontato;
		$this->contato				= $contato;
		$this->objpessoafisica 		= $objpessoafisica;
		$this->datacadastro 		= $datacadastro;
		$this->dataedicao 			= $dataedicao;
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjtipocontato() {
		return $this->objtipocontato;
	}
	public function setObjtipocontato($objtipocontato) {
		$this->objtipocontato = $objtipocontato;
		return $this;
	}
	public function getObjoperadoracontato() {
		return $this->objoperadoracontato;
	}
	public function setObjoperadoracontato($objoperadoracontato) {
		$this->objoperadoracontato = $objoperadoracontato;
		return $this;
	}
	public function getContato() {
		return $this->contato;
	}
	public function setContato($contato) {
		$this->contato = $contato;
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
	
	/*-- to string --*/
	public function __toString(){
		return sprintf("ContatoPF [ ID: %d, Objtipocontato: %s, Objoperadoracontato: %s, Pessoa Física: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->objtipocontato, $this->objoperadoracontato, $this->objpessoafisica->getNome(), $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'					=> $this->id,
			'idtipocontato'			=> $this->objtipocontato->jsonSerialize(),
			'idoperadoracontato'	=> $this->objoperadoracontato->jsonSerialize(),
			'contato'				=> $this->contato,
			'idpessoafisica'		=> $this->objpessoafisica->jsonSerialize(),
			'datacadastro'			=> $this->datacadastro,
			'dataedicao'			=> $this->dataedicao
		];
	}
	
}

?>