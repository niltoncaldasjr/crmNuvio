<?php 
class ContatoPF implements JsonSerializable
{
	/*-- atributos --*/
	private $id;
	private $tipo;
	private $operadora;
	private $contato;
	private $objpessoafisica;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 				= NULL,
		$tipo 				= NULL,
		$operadora 			= NULL,
		$contato 			= NULL,
		$objpessoafisica 	= NULL,
		$datacadastro		= NULL,
		$dataedicao 		= NULL
	)
	{
		$this->id 				= $id;
		$this->tipo 			= $tipo;
		$this->operadora	 	= $operadora;
		$this->contato			= $contato;
		$this->objpessoafisica 	= $objpessoafisica;
		$this->datacadastro 	= $datacadastro;
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
	public function getOperadora() {
		return $this->operadora;
	}
	public function setOperadora($operadora) {
		$this->operadora = $operadora;
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
		return sprintf("ContatoPF [ ID: %d, Tipo: %s, Operadora: %s, Pessoa Física: %s, Data Cadastro: %s, Data Edição: %s ]",
				$this->id, $this->tipo, $this->operadora, $this->objpessoafisica->getNome(), $this->datacadastro, $this->dataedicao );
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
			'id'			=> $this->id,
			'tipo'			=> $this->tipo,
			'operadora' 	=> $this->operadora,
			'contato'		=> $this->contato,
			'pessoafisica' 	=> $this->objpessoafisica->jsonSerialize(),
			'datacadastro'	=> $this->datacadastro,
			'dataedicao'	=> $this->dataedicao
		];
	}
	
}

?>