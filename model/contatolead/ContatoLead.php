<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/lead/Lead.php';

class ContatoLead implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $datacontato;
	private $descricao;
	private $dataretorno;
	private $datacadastro;
	private $dataedicao;
	private $objUsuario;
	private $objLead;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id					= NULL,
		$datacontato 		= NULL,
		$descricao 			= NULL,
		$dataretorno 		= NULL,
		$datacadastro 		= NULL,
		$dataedicao 		= NULL,
		Usuario $objUsuario = NULL,
		Lead 	$objLead 	= NULL
	)
	{
		$this->id 			= $id;
		$this->datacontato 	= $datacontato;
		$this->descricao 	= $descricao;
		$this->dataretorno 	= $dataretorno;
		$this->datacadastro = $datacadastro;
		$this->dataedicao 	= $dataedicao;
		$this->objUsuario 	= $objUsuario;
		$this->objLead 		= $objLead;
	}
	
	/*-- Getters Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getDatacontato() {
		return $this->datacontato;
	}
	public function setDatacontato($datacontato) {
		$this->datacontato = $datacontato;
		return $this;
	}
	public function getDataretorno() {
		return $this->dataretorno;
	}
	public function setDataretorno($dataretorno) {
		$this->dataretorno = $dataretorno;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
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
	public function getObjUsuario() {
		return $this->objUsuario;
	}
	public function setObjUsuario($objUsuario) {
		$this->objUsuario = $objUsuario;
		return $this;
	}
	public function getObjLead() {
		return $this->objLead;
	}
	public function setObjLead($objLead) {
		$this->objLead = $objLead;
		return $this;
	}
	
	/*-- ToString --*/
	public function __toString()
	{
		return sprintf("ContatoLead: [ ID: %d, DataContato: %s, Descricao: %s, DataRetorno: %s, DataCadastro: %s, DataEdicao: %s, Usuario: %s, Lead: %s ]",
				$this->id, $this->datacontato, $this->descricao, $this->dataretorno, $this->datacadastro, $this->dataedicao, $this->objUsuario->getNome(), $this->objLead->getEmpresa() );
	}
	
	/*-- Json --*/
	public function jsonSerialize() {
		return [
			'id' 			=> $this->id,
			'datacontato' 	=> $this->datacontato,
			'descricao'		=> $this->descricao,
			'dataretorno' 	=> $this->dataretorno,
			'datacadastro' 	=> $this->datacadastro,
			'dataeedicao' 	=> $this->dataedicao,
			'objUsuario' 	=> $this->objUsuario->jsonSerialize(),
			'objLead' 		=> $this->objLead->jsonSerialize()
		];
	}
	
	

}
?>