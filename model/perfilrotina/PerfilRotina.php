<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/perfil/Perfil.php'; //import
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/rotina/Rotina.php'; //import
class PerfilRotina implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $objRotina;
	private $objPerfil;
	
	/*-- Cronstrutor --*/
	public function __construct
	(
		$id=NULL,
		Rotina $objRotina=NULL,
		Perfil $objPerfil=NULL
	)
	{
		$this->id 			= $id;
		$this->objRotina 	= $objRotina;
		$this->objPerfil  	= $objPerfil;
	}
	
	/*-- Getters / Setters --*/
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getObjRotina() {
		return $this->objRotina;
	}
	public function setObjRotina($objRotina) {
		$this->objRotina = $objRotina;
		return $this;
	}
	public function getObjPerfil() {
		return $this->objPerfil;
	}
	public function setObjPerfil($objPerfil) {
		$this->objPerfil = $objPerfil;
		return $this;
	}
	
	/*-- ToString --*/
	public function toString()
	{
		return sprintf("PerfilRotina: [ID: %d, Rotina: %s[ID:%d], Perfil: %s[ID:%d]]", $this->id,  $this->objRotina->getNome(), $this->objRotina->getId(), $this->objPerfil->getNome(), $this->objPerfil->getId());
	}
	
	
	public function jsonSerialize() 
	{
		return [
			'id'		=> $this->id,
			'objRotina'	=> $this->objRotina,
			'objPerfil'	=> $this->objPerfil
		];
	}
	

}
?>