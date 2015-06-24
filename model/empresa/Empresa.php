<?php
class Empresa implements JsonSerializable {
	private $id;
	private $nomeFantasia;
	private $razaoSocial;
	private $nomeReduzido;
	private $CNPJ;
	private $inscricaoEstatual;
	private $inscricaoMunicipal;
	private $endereco;
	private $numero;
	private $complemento;
	private $bairro;
	private $cep;
	private $imagemLogotipo;
	private $login;
	private $datasis;
	private $idlocalidade;
	private $idimposto;
	
	function __construct($id = null, $nomeFantasia = null, $razaoSocial = null, $nomeReduzido = null, $CNPJ = null, $inscricaoEstatual = null, $inscricaoMunicipal = null, $endereco = null, $numero = null, $complemento = null, $bairro = null, $cep = null, $imagemLogotipo = null, $login = null, $datasis = null, $idlocalidade = null, $idimposto = null) {
		$this->id = $id;
		$this->nomeFantasia = $nomeFantasia;
		$this->razaoSocial = $razaoSocial;
		$this->nomeReduzido = $nomeReduzido;
		$this->CNPJ = $CNPJ;
		$this->inscricaoEstatual = $inscricaoEstatual;
		$this->inscricaoMunicipal = $inscricaoMunicipal;
		$this->endereco = $endereco;
		$this->numero = $numero;
		$this->complemento = $complemento;
		$this->bairro = $bairro;
		$this->cep = $cep;
		$this->imagemLogotipo = $imagemLogotipo;
		$this->login = $login;
		$this->datasis = $datasis;
		$this->idlocalidade = $idlocalidade;
		$this->idimposto = $idimposto;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNomeFantasia() {
		return $this->nomeFantasia;
	}
	public function setNomeFantasia($nomeFantasia) {
		$this->nomeFantasia = $nomeFantasia;
		return $this;
	}
	public function getRazaoSocial() {
		return $this->razaoSocial;
	}
	public function setRazaoSocial($razaoSocial) {
		$this->razaoSocial = $razaoSocial;
		return $this;
	}
	public function getNomeReduzido() {
		return $this->nomeReduzido;
	}
	public function setNomeReduzido($nomeReduzido) {
		$this->nomeReduzido = $nomeReduzido;
		return $this;
	}
	public function getCNPJ() {
		return $this->CNPJ;
	}
	public function setCNPJ($CNPJ) {
		$this->CNPJ = $CNPJ;
		return $this;
	}
	public function getInscricaoEstatual() {
		return $this->inscricaoEstatual;
	}
	public function setInscricaoEstatual($inscricaoEstatual) {
		$this->inscricaoEstatual = $inscricaoEstatual;
		return $this;
	}
	public function getInscricaoMunicipal() {
		return $this->inscricaoMunicipal;
	}
	public function setInscricaoMunicipal($inscricaoMunicipal) {
		$this->inscricaoMunicipal = $inscricaoMunicipal;
		return $this;
	}
	public function getEndereco() {
		return $this->endereco;
	}
	public function setEndereco($endereco) {
		$this->endereco = $endereco;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getComplemento() {
		return $this->complemento;
	}
	public function setComplemento($complemento) {
		$this->complemento = $complemento;
		return $this;
	}
	public function getBairro() {
		return $this->bairro;
	}
	public function setBairro($bairro) {
		$this->bairro = $bairro;
		return $this;
	}
	public function getCep() {
		return $this->cep;
	}
	public function setCep($cep) {
		$this->cep = $cep;
		return $this;
	}
	public function getImagemLogotipo() {
		return $this->imagemLogotipo;
	}
	public function setImagemLogotipo($imagemLogotipo) {
		$this->imagemLogotipo = $imagemLogotipo;
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
	public function getIdlocalidade() {
		return $this->idlocalidade;
	}
	public function setIdlocalidade($idlocalidade) {
		$this->idlocalidade = $idlocalidade;
		return $this;
	}
	public function getIdimposto() {
		return $this->idimposto;
	}
	public function setIdimposto($idimposto) {
		$this->idimposto = $idimposto;
		return $this;
	}
	public function jsonSerialize() {
		
		$empresa [] = [ 
				'id' => $this->id,
				'nomeFantasia' => $this->nomeFantasia,
				'razaoSocial' => $this->razaoSocial,
				'nomeReduzido' => $this->nomeReduzido,
				'CNPJ' => $this->CNPJ,
				'inscricaoEstatual' => $this->inscricaoEstatual,
				'inscricaoMunicipal' => $this->inscricaoMunicipal,
				'endereco' => $this->endereco,
				'numero' => $this->numero,
				'complemento' => $this->complemento,
				'bairro' => $this->bairro,
				'cep' => $this->cep,
				'imagemLogotipo' => $this->imagemLogotipo,
				'datasis' => $this->datasis,
				'idlocalidade' => $this->idlocalidade,
				'idimposto' => $this->idimposto 
		];
		$json = json_encode($empresa);
		echo $json;
	}
}