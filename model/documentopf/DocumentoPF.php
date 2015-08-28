<?php 
class DocumentoPF implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $tipo;
	private $numero;
	private $dataemissao;
	private $orgaoemissor;
	private $via;
	private $objpessoafisica;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 			= NULL,
		$tipo 			= NULL,
		$numero 		= NULL,
		$dataemissao 	= NULL,
		$orgaoemissor 	= NULL,
		$via 			= NULL,
		$objpesoafisica = NULL,
		$datacadastro 	= NULL,
		$dataedicao 	= NULL
	)
	{
		$this->id 				= $id;
		$this->tipo				= $tipo;
		$this->numero 			= $numero;
		$this->dataemissao 		= $dataemissao;
		$this->orgaoemissor		= $orgaoemissor;
		$this->via 				= $via;
		$this->objpessoafisica 	= $objpesoafisica;
		$this->datacadastro		= $datacadastro;
		$this->dataedicao 		= $dataedicao;
		
	}
	
	/*-- Getters and Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getDataemissao() {
		return $this->dataemissao;
	}
	public function setDataemissao($dataemissao) {
		$this->dataemissao = $dataemissao;
		return $this;
	}
	public function getOrgaoemissor() {
		return $this->orgaoemissor;
	}
	public function setOrgaoemissor($orgaoemissor) {
		$this->orgaoemissor = $orgaoemissor;
		return $this;
	}
	public function getVia() {
		return $this->via;
	}
	public function setVia($via) {
		$this->via = $via;
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
		return sprintf("DocumentoPF: [ ID: %d, Tipo: %s, Número: %s, Data Emissão: %s, Orgão Emissor: %s, Via: %d, Pessoa Física: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->tipo, $this->numero, $this->dataemissao, $this->orgaoemissor, $this->via, $this->objpessoafisica->getNome(), $this->datacadastro, $this->dataedicao);
	}
	
	/*-- Json --*/
	public function jsonSerialize(){
		return [
			'id' 			=> $this->id,
			'tipo'			=> $this->tipo,
			'numero'		=> $this->numero,
			'dataemissao'	=> $this->dataemissao,
			'orgaoemissor'	=> $this->orgaoemissor,
			'via'			=> $this->via,
			'pessoafisica'	=> $this->objpessoafisica->jsonSerialize(),
			'datacadastro'	=> $this->datacadastro,
			'dataedicao'	=> $this->dataedicao
		];
	}
}

?>