<?php
class Rotina implements JsonSerializable{
	private $id;
	private $nome;
	private $descricao;
	private $ordem;
	private $url;
	private $ativo;
	private $datacadastro;
	private $dataedicao;
	
	public function __construct($id=null, $nome=null, $descricao=null, $ordem=null, $url=null, $ativo=null, $datacadastro=null, $dataedicao=null){
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
		$this->ordem = $ordem;
		$this->url = $url;
		$this->ativo = $ativo;
		$this->datacadastro = $datacadastro;
		$this->dataedicao = $dataedicao;
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
	public function getOrdem() {
		return $this->ordem;
	}
	public function setOrdem($ordem) {
		$this->ordem = $ordem;
		return $this;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setUrl($url) {
		$this->url = $url;
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
		return "Pais [ id= " . $this->id . ", nome= " . $this->nome . ", sigla= " . $this->descricao . "ordem= " .$this->ordem . "url= " .$this->url . "ativo=" .$this->ativo . "datacadastro=" .$this->datacadastro . "dataedicao= " .$this->dataedicao . " ]";
	}
	
	
	
	public function jsonSerialize() {
		return [
				'id' => $this->id,
				'nome' => $this->nome,
				'descricao' => $this->descricao,
				'ordem' => $this->ordem,
				'url' => $this->url,
				'ativo' => $this->ativo,
				'datacadastro' =>$this->datacadastro,
				'dataedicao' => $this->dataedicao,
				
		];
	}

}
?>