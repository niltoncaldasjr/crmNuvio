<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/enderecopf/enderecopf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';

class enderecopf{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objEnderecoPF;
	private $listaEnderecoPF = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(enderecopf $objEnderecoPF){
		$this->sql = sprintf("INSERT INTO enderecopf (tipo, logradouro, numero, complemento, bairro, cep, idlocalidade, idpessoafisica)
				VALUES('%s', '%s', '%s', '%s', '%s', '%s', %d, %d)",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getLogradouro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getComplemento() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getBairro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getCep() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(enderecopf $objEnderecoPF){
		$this->sql = sprintf("UPDATE enderecopf SET tipo = '%s', logradouro = '%s', numero = '%s', complemento = '%s', bairro = '%s', cep = '%s', idlocalidade = %d, idpessoafisica = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getLogradouro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getComplemento() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getBairro() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getCep() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getObjLocalidade()->getId() ),
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objenderecopf = $objEnderecoPF;
	}

	/*-- Deletar --*/
	function deletar(enderecopf $objEnderecoPF){
		$this->sql = sprintf("DELETE FROM enderecopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objenderecopf = $objEnderecoPF;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(enderecopf $objEnderecoPF){
		$this->sql = sprintf("SELECT * FROM enderecopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objEnderecoPF->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objLocalidade = new Localidade();
			$objLocalidade->setId($row->idlocalidade);
			$objLocalidadeControl = new LocalidadeControl($objLocalidade);
			$objLocalidade = $objLocalidadeControl->buscarPorId();
			
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idPessoaFisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objenderecopf = new enderecopf($row->id, $row->tipo, $row->logradouro, $row->numero, $row->complemento, $row->bairro, $row->cep, $objLocalidade, $objPessoaFisica);
		}

		return $this->objenderecopf;
	}

	/*-- Listar Todos --*/
	function listarTodos(enderecopf $objEnderecoPF){
		$this->sql = "SELECT * FROM enderecopf";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objLocalidade = new Localidade();
			$objLocalidade->setId($row->idlocalidade);
			$objLocalidadeControl = new LocalidadeControl($objLocalidade);
			$objLocalidade = $objLocalidadeControl->buscarPorId();
			
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idPessoaFisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objenderecopf = new enderecopf($row->id, $row->tipo, $row->logradouro, $row->numero, $row->complemento, $row->bairro, $row->cep, $objLocalidade, $objPessoaFisica);

			array_push($this->listaenderecopf, $this->objenderecopf);
		}

		return $this->listaenderecopf;
	}

	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM enderecopf limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM enderecopf";
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