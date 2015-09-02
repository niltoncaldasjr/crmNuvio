<?php
class TipoContato implements JsonSerializable
{
	/*-- Atributos --*/
	private $id;
	private $descricao;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id=NULL,
		$descricao=NULL,
		$codigoBancoCentral=NULL,
		$datacadastro=NULL,
		$dataedicao=NULL
	)
	{
		$this->id 					= 	$id;
		$this->descricao 			= 	$descricao;
		$this->datacadastro 		= 	$datacadastro;
		$this->dataedicao 			= 	$dataedicao;
	}
	
	
	/*-- Getters / Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getCodigoBancoCentral() {
		return $this->codigoBancoCentral;
	}
	public function setCodigoBancoCentral($codigoBancoCentral) {
		$this->codigoBancoCentral = $codigoBancoCentral;
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
	
	/*-- ToString --*/
	public function toString()
	{
		return sprintf("Tipo Contato: [ ID: %d, Descricao: %s, CoodigoBancoCentral: %s, datacadastro: %s, dataedicao: %s ]", 
				$this->id, $this->descricao, $this->codigoBancoCentral, $this->datacadastro, $this->dataedicao);
	}
	
	/*-- json --*/
	public function jsonSerialize() {
		return [
			'id' 					=> $this->id,
			'descricao' 			=> $this->descricao,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao' 			=> $this->dataedicao
		];
	}

}
?>