<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/pais/Pais.php';
class Localidade implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $codigoIBGE;
	private $uf;
	private $cidade;
	private $datacadastro;
	private $dataedicao;
	private $objPais;
	
	/*-- construtor --*/
	public function __construct
	(
		$id=NULL,
		$codigoIBGE=NULL,
		$uf=NULL,
		$cidade=NULL,
		$datacadastro=NULL,
		$dataedicao=NULL,
		Pais $objPais=NULL
	)
	{
		$this->id = $id;
		$this->codigoIBGE = $codigoIBGE;
		$this->uf = $uf;
		$this->cidade = $cidade;
		$this->datacadastro  = $datacadastro;
		$this->dataedicao = $dataedicao;
		$this->objPais = $objPais;
	}
	
	/*-- Getters Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getCodigoIBGE() {
		return $this->codigoIBGE;
	}
	public function setCodigoIBGE($codigoIBGE) {
		$this->codigoIBGE = $codigoIBGE;
		return $this;
	}
	public function getUf() {
		return $this->uf;
	}
	public function setUf($uf) {
		$this->uf = $uf;
		return $this;
	}
	public function getCidade() {
		return $this->cidade;
	}
	public function setCidade($cidade) {
		$this->cidade = $cidade;
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
	public function getObjPais() {
		return $this->objPais;
	}
	public function setObjPais($objPais) {
		$this->objPais = $objPais;
		return $this;
	}
	
	/*-- ToString --*/
	public function __toString()
	{
		return sprintf("Localidade: [ ID:%d, CodigoIBGE: %d, UF: %s, Cidade: %s, DataCadastro: %s, DataEdicao: %s, Pais: %s]",
				$this->id, $this->codigoIBGE, $this->uf, $this->cidade, $this->datacadastro, $this->dataedicao, $this->objPais->getDescricao() );	
	}
	
	/*-- Json --*/
	public function jsonSerialize(){
		return [
			'id' => $this->id,
			'codigoIBGE' => $this->codigoIBGE,
			'uf' 	=> $this->uf,
			'cidade' => $this->cidade,
			'datacadastro' => $this->datacadastro,
			'dataedicao' => $this->dataedicao,
			'pais' => $this->objPais
		];
	}
	
	
	
}
?>