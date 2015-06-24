<?php
class Banco implements JsonSerializable
{
	/*-- Atributos --*/
	private $id;
	private $nome;
	private $codigoBancoCentral;
	private $login;
	private $datasis;
	
	/*-- Construtor --*/
	public function __construct
	(
		$id=NULL,
		$nome=NULL,
		$codigoBancoCentral=NULL,
		$login=NULL,
		$datasis=NULL
	)
	{
		$this->id 					= $id;
		$this->nome 				= $nome;
		$this->codigoBancoCentral 	= $codigoBancoCentral;
		$this->login 				= $login;
		$this->datasis 				= $datasis;
	}
	
	
	/*-- Getters / Setters --*/
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
	public function getCodigoBancoCentral() {
		return $this->codigoBancoCentral;
	}
	public function setCodigoBancoCentral($codigoBancoCentral) {
		$this->codigoBancoCentral = $codigoBancoCentral;
		return $this;
	}
	public function getLogin() {
		return $this->login;
	}
	public function setLogin($login) {
		$this->login = $login;
		return $this;
	}
	public function getDatasis() {
		return $this->datasis;
	}
	public function setDatasis($datasis) {
		$this->datasis = $datasis;
		return $this;
	}
	
	/*-- ToString --*/
	public function toString()
	{
		return sprintf("Banco: [ ID: %d, Nome: %s, CoodigoBancoCentral: %s, Login: %s, DataSis: %s ]", 
				$this->id, $this->nome, $this->codigoBancoCentral, $this->login, $this->datasis);
	}
	
	/*-- json --*/
	public function jsonSerialize() {
		return [
			'id' 					=> $this->id,
			'nome' 					=> $this->nome,
			'codigoBancoCentral' 	=> $this->codigoBancoCentral,
			'login'					=> $this->login,
			'datasis' 				=> $this->datasis
		];
	}

}
?>