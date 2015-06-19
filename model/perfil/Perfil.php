<?php
class Perfil implements JsonSerializable{
	private $id;
	private $nome;
	private $ativo;
	private $datacadastrado;
	private $dataedicao;
	
	function __construct($id=null, $nome=null, $ativo=null, $datacadastrado=null, $dataedicao=null){
		$this->id     		  = $id;
		$this->nome           = $nome;
		$this->ativo          = $ativo;
		$this->datacadastrado = $datacadastrado;
		$this->dataedicao     = $dataedicao;
	}
	
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
	public function getAtivo() {
		return $this->ativo;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
		return $this;
	}
	public function getDatacadastrado() {
		return $this->datacadastrado;
	}
	public function setDatacadastrado($datacadastrado) {
		$this->datacadastrado = $datacadastrado;
		return $this;
	}
	public function getDataedicao() {
		return $this->dataedicao;
	}
	public function setDataedicao($dataedicao) {
		$this->dataedicao = $dataedicao;
		return $this;
	}
	
	function __toString(){
		return "Perfil [ id= " . $this->id . ", nome=" . $this->nome . ", ativo=" . $this->ativo . 
		", dataCadastrado=" . $this->datacadastrado . " , dataEdicao=" . $this->dataedicao . "]";
	}
	
	public function jsonSerialize() {
		return [
				'id' => $this->id,
				'nome' => $this->nome,
				'ativo' => $this->ativo,
				'dataCadastrado' => $this->datacadastrado,
				'dataEdicao' => $this->dataedicao				
		];
	}
	
}

