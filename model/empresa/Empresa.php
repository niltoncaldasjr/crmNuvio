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
	private $datacadastro;
	private $dataedicao;
	private $objLocalidade;
	private $objImposto;
	
	function __construct($id, $nomeFantasia, $razaoSocial, $nomeReduzido, $CNPJ, $inscricaoEstatual, $inscricaoMunicipal, $endereco, $numero, $complemento, $bairro, $cep, $imagemLogotipo, $datacadastro, $dataedicao, $objLocalidade, $objImposto) {
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
            $this->datacadastro = $datacadastro;
            $this->dataedicao = $dataedicao;
            $this->objLocalidade = $objLocalidade;
            $this->objImposto = $objImposto;
        }

        function getId() {
            return $this->id;
        }

        function getNomeFantasia() {
            return $this->nomeFantasia;
        }

        function getRazaoSocial() {
            return $this->razaoSocial;
        }

        function getNomeReduzido() {
            return $this->nomeReduzido;
        }

        function getCNPJ() {
            return $this->CNPJ;
        }

        function getInscricaoEstatual() {
            return $this->inscricaoEstatual;
        }

        function getInscricaoMunicipal() {
            return $this->inscricaoMunicipal;
        }

        function getEndereco() {
            return $this->endereco;
        }

        function getNumero() {
            return $this->numero;
        }

        function getComplemento() {
            return $this->complemento;
        }

        function getBairro() {
            return $this->bairro;
        }

        function getCep() {
            return $this->cep;
        }

        function getImagemLogotipo() {
            return $this->imagemLogotipo;
        }

        function getDatacadastro() {
            return $this->datacadastro;
        }

        function getDataedicao() {
            return $this->dataedicao;
        }

        function getObjLocalidade() {
            return $this->objLocalidade;
        }

        function getObjImposto() {
            return $this->objImposto;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNomeFantasia($nomeFantasia) {
            $this->nomeFantasia = $nomeFantasia;
        }

        function setRazaoSocial($razaoSocial) {
            $this->razaoSocial = $razaoSocial;
        }

        function setNomeReduzido($nomeReduzido) {
            $this->nomeReduzido = $nomeReduzido;
        }

        function setCNPJ($CNPJ) {
            $this->CNPJ = $CNPJ;
        }

        function setInscricaoEstatual($inscricaoEstatual) {
            $this->inscricaoEstatual = $inscricaoEstatual;
        }

        function setInscricaoMunicipal($inscricaoMunicipal) {
            $this->inscricaoMunicipal = $inscricaoMunicipal;
        }

        function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        function setNumero($numero) {
            $this->numero = $numero;
        }

        function setComplemento($complemento) {
            $this->complemento = $complemento;
        }

        function setBairro($bairro) {
            $this->bairro = $bairro;
        }

        function setCep($cep) {
            $this->cep = $cep;
        }

        function setImagemLogotipo($imagemLogotipo) {
            $this->imagemLogotipo = $imagemLogotipo;
        }

        function setDatacadastro($datacadastro) {
            $this->datacadastro = $datacadastro;
        }

        function setDataedicao($dataedicao) {
            $this->dataedicao = $dataedicao;
        }

        function setObjLocalidade($objLocalidade) {
            $this->objLocalidade = $objLocalidade;
        }

        function setObjImposto($objImposto) {
            $this->objImposto = $objImposto;
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
				'datacadastro' => $this->datacadastro,  
				'dataedicao' => $this->dataedicao,
				'localidade' => $this->idlocalidade,
				'imposto' => $this->idimposto 
		];
		$json = json_encode($empresa);
		echo $json;
	}
}