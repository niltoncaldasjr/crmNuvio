<?php
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/usuario/Usuario.php'; //import
require_once $_SERVER['DOCUMENT_ROOT'] .  "/crmNuvio/" . 'model/rotina/Rotina.php'; //import

class UsuarioRotina implements JsonSerializable{
	
	/*-- Atributos --*/
	private $id;
	private $datacadastro;
	private $objRotina;
	private $objUsuario;
	private $consulta;
	private $incluir;
	private $alterar;
	private $excluir;
	
	/*-- Cronstrutor --*/
	public function __construct
	(
		$id					=	NULL,
		$datacadastro 		=   NULL,
		Rotina $objRotina	=	NULL,
		Usuario $objUsuario =   NULL,
		$consulta			= 	null,
		$incluir 			= 	null,
		$alterar 			=	null,
		$excluir 			=	null
	)
	{
		$this->id 			= $id;
		$this->datacadastro = $datacadastro;
		$this->objRotina 	= $objRotina;
		$this->objUsuario	= $objUsuario;
		$this->consulta = $consulta;
		$this->incluir = $incluir;
		$this->alterar = $alterar;
		$this->excluir = $excluir;
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
	public function getConsulta() {
		return $this->consulta;
	}
	public function setConsulta($consulta) {
		$this->consulta = $consulta;
	}
	public function getIncluir() {
		return $this->incluir;
	}
	public function setIncluir($incluir) {
		$this->incluir = $incluir;
	}
	public function getAlterar() {
		return $this->alterar;
	}
	public function setAlterar($alterar) {
		$this->alterar = $alterar;
	}
	public function getExcluir() {
		return $this->excluir;
	}
	public function setExcluir($excluir) {
		$this->excluir = $excluir;
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
			'objUsuario'	=> $this->objUsuario,
			'consulta'		=> $this->consulta,
			'incluir'		=> $this->incluir,
			'alterar'		=> $this->alterar,
			'excluir'		=> $this->excluir
				
		];
	}
	
	
	
	

}
?>