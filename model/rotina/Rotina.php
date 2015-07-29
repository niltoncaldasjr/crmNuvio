<?php
class Rotina implements JsonSerializable{
	private $id;
	private $nome;
	private $descricao;
	private $subrotina;
	private $class;
	private $icon;
	private $ativo;
	private $datacadastro;
	private $dataedicao;
	
	public function __construct($id=null, $nome=null, $descricao=null, $subrotina=null, $class=null, $icon=null, $ativo=null, $datacadastro=null, $dataedicao=null){
		$this->id 			= $id;
		$this->nome 		= $nome;
		$this->descricao 	= $descricao;
		$this->subrotina 	= $subrotina;
		$this->class 		= $class;
		$this->subrotina 	= $subrotina;
		$this->ativo 		= $ativo;
		$this->datacadastro = $datacadastro;
		$this->dataedicao 	= $dataedicao;
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
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
		return $this;
	}
	public function getSubrotina() {
		return $this->subrotina;
	}
	public function setSubrotina($subrotina) {
		$this->subrotina = $subrotina;
		return $this;
	}
	public function getClass() {
		return $this->class;
	}
	public function setClass($class) {
		$this->class = $class;
		return $this;
	}
	public function getIcon() {
		return $this->icon;
	}
	public function setIcon($icon) {
		$this->icon = $icon;
		return $this;
	}
	public function getAtivo() {
		return $this->ativo;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
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
	
	
	public function __toString(){
		return "Rotina [ id= " . $this->id . ", nome= " . $this->nome . ", sigla= " . $this->descricao . "subrotina= " .$this->subrotina . "class= " .$this->class . "icon= " .$this->icon . "ativo=" .$this->ativo . "datacadastro=" .$this->datacadastro . "dataedicao= " .$this->dataedicao . " ]";
	}
	
	
	
	public function jsonSerialize() {
		return [
				'id' => $this->id,
				'nome' => $this->nome,
				'descricao' => $this->descricao,
				'subrotina' => $this->subrotina,
				'class' => $this->class,
				'icon' => $this->icon,
				'ativo' => $this->ativo,
				'datacadastro' =>$this->datacadastro,
				'dataedicao' => $this->dataedicao,
				
		];
	}

}
?>