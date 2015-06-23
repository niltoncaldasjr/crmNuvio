<?php
class Usuario implements JsonSerializable{
	private $id;
	private $nome;
	private $usuario;
	private $senha;
	private $email;
	private $ativo;
	private $datacadastrado;
	private $dataedicao;
	private $idperfil;
	private $idpessoafisica;
	
	
	function __construct($id = null, $nome = null, $usuario = null, $senha = null, $email = null, $ativo = null, $datacadastrado = null, $dataedicao = null, $idperfil = null, $idpessoafisica = null) {
		$this->id = $id;
		$this->nome = $nome;
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->email = $email;
		$this->ativo = $ativo;
		$this->datacadastrado = $datacadastrado;
		$this->dataedicao = $dataedicao;
		$this->idperfil = $idperfil;
		$this->idpessoafisica = $idpessoafisica;
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
	public function getUsuario() {
		return $this->usuario;
	}
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
		return $this;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = md5($senha);
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
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
	public function getIdperfil() {
		return $this->idperfil;
	}
	public function setIdperfil($idperfil) {
		$this->idperfil = $idperfil;
		return $this;
	}
	public function getIdpessoafisica() {
		return $this->idpessoafisica;
	}
	public function setIdpessoafisica($idpessoafisica) {
		$this->idpessoafisica = $idpessoafisica;
		return $this;
	}
	
	public function jsonSerialize() {
		$usuarios[] = [
				'id' => $this->id,
				'nome' => $this->nome,
				'usuario' => $this->usuario,
				'senha' => $this->senha,
				'email' => $this->email,
				'ativo' => $this->ativo,
				'dataCadastrado' => $this->datacadastrado,
				'dataEdicao' => $this->dataedicao,
				'idPerfil' => $this->idperfil,
				'idPessoaFisica' => $this->idpessoafisica
		];
		$json = json_encode($usuarios);
		echo $json;
	}
	
}