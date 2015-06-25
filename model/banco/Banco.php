<?php
class Banco implements JsonSerializable
{
	/*-- Atributos --*/
	private $id;
	private $nome;
	private $codigoBancoCentral;
	private $datacadastro;
	private $dataedicao;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id=NULL,
		$nome=NULL,
		$codigoBancoCentral=NULL,
		$datacadastro=NULL,
		$dataedicao=NULL
	)
	{
		$this->id 					= 	$id;
		$this->nome 				= 	$nome;
		$this->codigoBancoCentral 	= 	$codigoBancoCentral;
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
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
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
		return sprintf("Banco: [ ID: %d, Nome: %s, CoodigoBancoCentral: %s, datacadastro: %s, dataedicao: %s ]", 
				$this->id, $this->nome, $this->codigoBancoCentral, $this->datacadastro, $this->dataedicao);
	}
	
	/*-- json --*/
	public function jsonSerialize() {
		return [
			'id' 					=> $this->id,
			'nome' 					=> $this->nome,
			'codigoBancoCentral' 	=> $this->codigoBancoCentral,
			'datacadastro'			=> $this->datacadastro,
			'dataedicao' 			=> $this->dataedicao
		];
	}

}
?>