<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/EnderecoPF/EnderecoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';

class EnderecoPFDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objEnderecoPF;
	private $listaEnderecoPF = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(EnderecoPF $objEnderecoPF){
		$this->sql = sprintf("INSERT INTO EnderecoPF (idtipoendereco, logradouro, numero, complemento, bairro, cep, idlocalidade, idpessoafisica)
				VALUES(%d, '%s', '%s', '%s', '%s', '%s', %d, %d)",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjtipoendereco()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getLogradouro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getComplemento() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getBairro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getCep() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjpessoafisica()->getId() ) );
		
		var_dump($this->sql);

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(EnderecoPF $objEnderecoPF){
		$this->sql = sprintf("UPDATE EnderecoPF SET idtipoendereco = %d, logradouro = '%s', numero = '%s', complemento = '%s', bairro = '%s', cep = '%s', idlocalidade = %d, idpessoafisica = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjtipoendereco()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getLogradouro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getComplemento() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getBairro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getCep() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjpessoafisica()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objEnderecoPF = $objEnderecoPF;
	}

	/*-- Deletar --*/
	function deletar(EnderecoPF $objEnderecoPF){
		$this->sql = sprintf("DELETE FROM EnderecoPF WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objEnderecoPF = $objEnderecoPF;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(EnderecoPF $objEnderecoPF){
		$this->sql = sprintf("SELECT * FROM EnderecoPF WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objTipoEndereco = new TipoEndereco();
			$objTipoEndereco->setId($row->idtipoendereco);
			$objTipoEnderecoControl = new TipoEnderecoControl($objTipoEndereco);
			$objTipoEndereco = $objTipoEnderecoControl->buscarPorId();
			
			$objLocalidade = new Localidade();
			$objLocalidade->setId($row->idlocalidade);
			$objLocalidadeControl = new LocalidadeControl($objLocalidade);
			$objLocalidade = $objLocalidadeControl->buscarPorId();
			
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objEnderecoPF = new EnderecoPF($row->id, $objTipoEndereco, $row->logradouro, $row->numero, $row->complemento, $row->bairro, $row->cep, $objLocalidade, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
		}

		return $this->objEnderecoPF;
	}

	/*-- Listar Todos --*/
	function listarTodos(EnderecoPF $objEnderecoPF){
		$this->sql = "SELECT * FROM EnderecoPF";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objTipoEndereco = new TipoEndereco();
			$objTipoEndereco->setId($row->idtipoendereco);
			$objTipoEnderecoControl = new TipoEnderecoControl($objTipoEndereco);
			$objTipoEndereco = $objTipoEnderecoControl->buscarPorId();
			
			$objLocalidade = new Localidade();
			$objLocalidade->setId($row->idlocalidade);
			$objLocalidadeControl = new LocalidadeControl($objLocalidade);
			$objLocalidade = $objLocalidadeControl->buscarPorId();
			
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objEnderecoPF = new EnderecoPF($row->id, $objTipoEndereco, $row->logradouro, $row->numero, $row->complemento, $row->bairro, $row->cep, $objLocalidade, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
		
			array_push($this->listaEnderecoPF, $this->objEnderecoPF);
		}

		return $this->listaEnderecoPF;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorPessoaFisica($idpessoafisica){
		$this->sql = "SELECT * FROM enderecopf WHERE idpessoafisica = $idpessoafisica";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}

		$lista = array();

		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$lista[]=$row;
		}
		//teste
		return $lista;
	}

	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM EnderecoPF limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}

		$lista = array();

		while ( $row = mysqli_fetch_assoc ( $result ) ) {
			$lista[]=$row;
		}
		//teste
		return $lista;
	}

	/*-- Quantidade Total --*/
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM EnderecoPF";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		$total = 0;
		while ( $row = mysqli_fetch_object ( $result ) ) {
			$total = $row->quantidade;
		}

		return $total;
	}


}
?>