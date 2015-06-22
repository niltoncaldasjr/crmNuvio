<?php
class Lead implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $empresa;
	private $email;
	private $telefone;
	private $contato;
	private $datacadastro;
	private $dataedicao;
	private $ativo;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id=NULL,
		$empresa=NULL,
		$email=NULL,
		$telefone=NULL,
		$contato=NULL,
		$datacadastro=NULL,
		$dataedicao=NULL,
		$ativo=NULL
	)
	{
		$this->id 			= $id;
		$this->empresa 		= $empresa;
		$this->email 		= $email;
		$this->telefone 	= $telefone;
		$this->contato		= $contato;
		$this->datacadastro = $datacadastro;
		$this->dataedicao 	= $dataedicao;
		$this->ativo 		= $ativo;
	}
	
	/*-- Getters / Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getEmpresa() {
		return $this->empresa;
	}
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getTelefone() {
		return $this->telefone;
	}
	public function setTelefone($telefone) {
		$this->telefone = $telefone;
		return $this;
	}
	public function getContato() {
		return $this->contato;
	}
	public function setContato($contato) {
		$this->contato = $contato;
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
	public function getAtivo() {
		return $this->ativo;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
		return $this;
	}
	
	/*-- ToString --*/
	public function toString()
	{
		return sprintf(
			"Lead: [ID: %d, Empresa: %s, Email: %s, Telefone: %s, Contato: %s, Data Cadastro: %s, Data Ediчуo: %s, Ativo: %d]",
			$this->id, $this->empresa, $this->email, $this->telefone, $this->contato, $this->datacadastro, $this->dataedicao, $this->ativo 
		);
	}
	
	/*-- Json Serialize --*/
	public function jsonSerialize()
	{
		return[
			'id'			=> $this->id,
			'empresa'		=> $this->empresa,
			'email'			=> $this->email,
			'telefone'		=> $this->telefone,
			'contato'		=> $this->contato,
			'datacadastro'	=> $this->datacadastro,
			'dataedicao'	=> $this->dataedicao,
			'ativo'			=> $this->ativo
		];
	}
	
	
}
?>