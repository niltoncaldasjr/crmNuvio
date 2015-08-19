<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/usuario/Usuario.php'; //import
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/rotina/Rotina.php'; //import

class UsuarioRotina implements JsonSerializable{
	
	/*-- Atributos --*/
	private $id;
	private $datacadastro;
	private $objRotina;
	private $objUsuario;
	
	/*-- Cronstrutor --*/
	public function __construct
	(
		$id					=	NULL,
		$datacadastro 		=   NULL,
		Rotina $objRotina	=	NULL,
		Usuario $objUsuario =   NULL
	)
	{
		$this->id 			= $id;
		$this->datacadastro = $datacadastro;
		$this->objRotina 	= $objRotina;
		$this->objUsuario	= $objUsuario;
	}
	
	/*-- Getters / Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getObjUsuario() {
		return $this->objUsuario;
	}
	public function setObjUsuario($objUsuario) {
		$this->objUsuario = $objUsuario;
		return $this;
	}
	public function getDatacadastro() {
		return $this->datacadastro;
	}
	public function setDatacadastro($datacadastro) {
		$this->datacadastro = $datacadastro;
		return $this;
	}
	public function getObjRotina() {
		return $this->objRotina;
	}
	public function setObjRotina($objRotina) {
		$this->objRotina = $objRotina;
		return $this;
	}
	
	
	/*-- ToString --*/
	public function toString()
	{
		return sprintf("PerfilRotina: [ID: %d, DataCadastro: %s, Rotina: %s[ID:%d], Perfil: %s[ID:%d]]", $this->id, $this->datacadastro,  $this->objRotina->getNome(), $this->objRotina->getId(), $this->objUsuario->getNome(), $this->objUsuario->getId());
	}
	
	
	public function jsonSerialize() 
	{
		return [
			'id'			=> $this->id,
			'datacadastro' 	=> $this->datacadastro,
			'objRotina'		=> $this->objRotina,
			'objUsuario'		=> $this->objUsuario->jsonSerialize()
		];
	}
	
	
	
	

}
?>