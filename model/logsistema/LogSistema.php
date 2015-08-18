<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
class LogSistema implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $nivel;
	private $acao;
	private $class;
	private $idregistro;
	private $antes;
	private $depois;
	private $datacadastro;
	private $objUsuario;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id 				=	NULL,
		$nivel 				= 	NULL,
		$acao 				=	NULL,
		$class 				=	NULL,
		$idregistro			= 	NULL,
		$antes				=	NULL,
		$depois				=	NULL,
		$datacadastro 		=	NULL,
		Usuario $objUsuario = 	NULL
		
	)
	{
		$this->id 				= $id;
		$this->nivel 			= $nivel;
		$this->acao 			= $acao;
		$this->class 			= $class;
		$this->idregistro 		= $idregistro;
		$this->antes 			= $antes;
		$this->datacadastro 	= $datacadastro;
		$this->objUsuario 		= $objUsuario;
	}
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNivel() {
		return $this->nivel;
	}
	public function setNivel($nivel) {
		$this->nivel = $nivel;
		return $this;
	}
	public function getAcao() {
		return $this->acao;
	}
	public function setAcao($acao) {
		$this->acao = $acao;
		return $this;
	}
	public function getClass() {
		return $this->class;
	}
	public function setClass($class) {
		$this->class = $class;
		return $this;
	}
	public function getIdregistro() {
		return $this->idregistro;
	}
	public function setIdregistro($idregistro) {
		$this->idregistro = $idregistro;
		return $this;
	}
	public function getAntes() {
		return $this->antes;
	}
	public function setAntes($antes) {
		$this->antes = $antes;
		return $this;
	}
	public function getDepois() {
		return $this->depois;
	}
	public function setDepois($depois) {
		$this->depois = $depois;
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
	
	/*-- ToString --*/
	public function __toString()
	{
		return sprintf("LogSistema: [ ID: %d, Nivel: %s, Ação: %s, Class: %s, IDRegistro: %d, Antes: %s, Depois: %s, DataCadastro: %s, Usuário: %s ]",
				$this->id, $this->nivel, $this->acao, $this->class, $this->idregistro, $this->antes, $this->depois, $this->datacadastro, $this->objUsuario->getNome() );
	}
	
	/*-- Json --*/
	public function jsonSerialize() {
		return [
			'id' 			=> 	$this->id,
			'nivel' 		=> 	$this->datacadastro,
			'acao'			=>  $this->acao,
			'class'			=> 	$this->class,
			'idregistro'	=> 	$this->idregistro,
			'antes'			=>	$this->antes,
			'depois'		=> 	$this->depois,
			'datacadastro'	=>	$this->datacadastro,
			'objUsuario' 	=> 	$this->objUsuario->jsonSerialize()
		];
	}
	
	
}
?>