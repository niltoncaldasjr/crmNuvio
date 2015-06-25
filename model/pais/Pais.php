<?php
class Pais implements JsonSerializable {
	private $id;
	private $descricao;
	private $nacionalidade;
	private $datacadastro;
	private $dataedicao;
	function __construct($id = null, $desc = null, $nasc = null, $dtcad = null, $dtedicao = null) {
		$this->id = $id;
		$this->descricao = $desc;
		$this->nacionalidade = $nasc;
		$this->datacadastro = $dtcad;
		$this->dataedicao = $dtedicao;
	}
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
	public function getNacionalidade() {
		return $this->nacionalidade;
	}
	public function setNacionalidade($nacionalidade) {
		$this->nacionalidade = $nacionalidade;
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
	public function jsonSerialize() {
		$pais [] = [ 
				'id' => $this->id,
				'descricao' => $this->descricao,
				'nacionalidade' => $this->nacionalidade,
				'datacadastro' => $this->datacadastro,
				'dataedicao' => $this->dataedicao
		];
		$json = json_encode ( $pais );
		echo $json;
	}
}