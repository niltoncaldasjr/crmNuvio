<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
class LogSistema implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $ocorrencia;
	private $nivel;
	private $datacadastro;
	private $objUsuario;
	private $acao;
	private $class;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 				=	NULL,
		$ocorrencia 		= 	NULL,
		$nivel 				= 	NULL,
		$datacadastro 		=	NULL,
		Usuario $objUsuario = 	NULL,
		$acao 				=	NULL,
		$class 				=	NULL
	)
	{
		$this->id = $id;
		$this->ocorrencia = $ocorrencia;
		$this->nivel = $nivel;
		$this-> datacadastro = $datacadastro;
		$this->objUsuario = $objUsuario;
		$this->acao = $acao;
		$this->class = $class;
	}
	
	/*-- Getters Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getOcorrencia() {
		return $this->ocorrencia;
	}
	public function setOcorrencia($ocorrencia) {
		$this->ocorrencia = $ocorrencia;
		return $this;
	}
	public function getNivel() {
		return $this->nivel;
	}
	public function setNivel($nivel) {
		$this->nivel = $nivel;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getObjUsuario() {
		return $this->objUsuario;
	}
	public function setObjUsuario($objUsuario) {
		$this->objUsuario = $objUsuario;
		return $this;
	}
	public function getAcao() {
		return $this->objUsuario;
	}
	public function setAcao($acao) {
		$this->objUsuario = $acao;
		return $this;
	}
	public function getClass() {
		return $this->objUsuario;
	}
	public function setClass($class) {
		$this->objUsuario = $class;
		return $this;
	}
	
	/*-- ToString --*/
	public function __toString()
	{
		return sprintf("LogSistema: [ ID: %d, Ocorrencia: %s, Nivel: %s, DataCadastro: %s, Usuario: %s, Acao: %s, Class: %s ]",
				$this->id, $this->ocorrencia, $this->nivel, $this->datacadastro, $this->objUsuario->getNome(), $this->acao, $this->class );
	}
	
	/*-- Json --*/
	public function jsonSerialize() {
		return [
			'id' 			=> 	$this->id,
			'ocorrencia' 	=> 	$this->ocorrencia,
			'nivel' 		=> 	$this->datacadastro,
			'objUsuario' 	=> 	$this->objUsuario->jsonSerialize()
		];
	}

	
}
?>