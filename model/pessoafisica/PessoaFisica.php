<?php
class PessoaFisica implements JsonSerializable{
	/*-- Atributos --*/
	private $id;
	private $nome;
	private $cpf;
	private $datanascimento;
	private $estadocivil;
	private $sexo;
	private $nomepai;
	private $nomemae;
	private $cor;
	private $naturalidade;
	private $nacionalidade;
	private $datacadastro;
	private $dataedicao;
		
	/*-- Construtor --*/
	public function __construct
	(
		$id				=	NULL, 
		$nome			=	NULL, 
		$cpf			=	NULL, 
		$datanascimento	=	NULL, 
		$estadocivil	=	NULL, 
		$sexo			=	NULL, 
		$nomepai		=	NULL, 
		$nomemae		=	NULL, 
		$cor			=	NULL, 
		$naturalidade	=	NULL, 
		$nacionalidade	=	NULL,
		$datacadastro	=	NULL, 
		$dataedicao		=	NULL
	)
	{
		$this->id 				= 	$id;
		$this->nome 			= 	$nome;
		$this->cpf 				= 	$cpf;
		$this->datanascimento 	= 	$datanascimento;
		$this->estadocivil 		= 	$estadocivil;
		$this->sexo 			=	$sexo;
		$this->nomepai 			= 	$nomepai;
		$this->nomemae 			= 	$nomemae;
		$this->cor 				= 	$cor;
		$this->naturalidade 	= 	$naturalidade;
		$this->nacionalidade 	= 	$nacionalidade;
		$this->datacadastro 	= 	$datacadastro;
		$this->dataedicao 		= 	$dataedicao;
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
	public function getCpf() {
		return $this->cpf;
	}
	public function setCpf($cpf) {
		$this->cpf = $cpf;
		return $this;
	}
	public function getDatanascimento() {
		return $this->datanascimento;
	}
	public function setDatanascimento($datanascimento) {
		$this->datanascimento = $datanascimento;
		return $this;
	}
	public function getEstadocivil() {
		return $this->estadocivil;
	}
	public function setEstadocivil($estadocivil) {
		$this->estadocivil = $estadocivil;
		return $this;
	}
	public function getSexo() {
		return $this->sexo;
	}
	public function setSexo($sexo) {
		$this->sexo = $sexo;
		return $this;
	}
	public function getNomepai() {
		return $this->nomepai;
	}
	public function setNomepai($nomepai) {
		$this->nomepai = $nomepai;
		return $this;
	}
	public function getNomemae() {
		return $this->nomemae;
	}
	public function setNomemae($nomemae) {
		$this->nomemae = $nomemae;
		return $this;
	}
	public function getCor() {
		return $this->cor;
	}
	public function setCor($cor) {
		$this->cor = $cor;
		return $this;
	}
	public function getNaturalidade() {
		return $this->naturalidade;
	}
	public function setNaturalidade($naturalidade) {
		$this->naturalidade = $naturalidade;
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
	
	/*-- ToString --*/
	public function toStirng()
	{
		
		return sprintf(
				"Pessoa Física: [ID: %d, Nome: %s, CPF: %s, Data Nascimento: %s, Estado Cívil: %s, Sexo: %s, Nome Pai: %s, Nome Mãe: %s, "
				."Cor: %s, Naturalidade: %s, Nacionalidade: %s, Data Cadastro: %s, Data Edicao: %s]",
				$this->id, 
				$this->nome, 
				$this->cpf, 
				$this->datanascimento, 
				$this->estadocivil, 
				$this->sexo, 
				$this->nomepai, 
				$this->nomemae,
				$this->cor, 
				$this->naturalidade, 
				$this->nacionalidade, 
				$this->datacadastro, 
				$this->dataedicao);
		
	}
	
	/*-- Json Serializable --*/
	public function jsonSerialize(){
		return[
				'id' 				=> $this->id,
				'nome' 				=> $this->nome,
				'cpf'				=> $this->cpf,
				'datanascimento'	=> $this->datanascimento,
				'estadocivil'		=> $this->estadocivil,
				'sexo'				=> $this->sexo,
				'nomepai'			=> $this->nomepai,
				'nomemae'			=> $this->nomemae,
				'cor'				=> $this->cor,
				'naturalidade'		=> $this->naturalidade,
				'nacionalidade'		=> $this->nacionalidade,
				'datacadastro'		=> $this->datacadastro,
				'dataedicao' 		=> $this->dataedicao
		];
	}
	
}
?>