<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/documentopf/DocumentoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';

class DocumentoPFDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objDocumentoPF;
	private $listaDocumentoPF = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(DocumentoPF $objDocumentoPF){
		$this->sql = sprintf("INSERT INTO documentopf (tipo, numero, dataemissao, orgaoemissor, via, idpessoafisica)
				VALUES('%s', '%s', '%s', '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getDataemissao() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getOrgaoemissor() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getVia() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getObjPessoafisica()->getId() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(DocumentoPF $objDocumentoPF){
		$this->sql = sprintf("UPDATE documentopf SET tipo = '%s', numero = '%s', dataemissao = '%s', orgaoemissor = '%s', via = '%s', idpessoafisica = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getNumero() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getDataemissao() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getOrgaoemissor() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getVia() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getObjPessoaFisica()->getId() ),
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objDocumentoPF = $objDocumentoPF;
	}

	/*-- Deletar --*/
	function deletar(DocumentoPF $objDocumentoPF){
		$this->sql = sprintf("DELETE FROM documentopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objDocumentoPF = $objDocumentoPF;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(DocumentoPF $objDocumentoPF){
		$this->sql = sprintf("SELECT * FROM documentopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objDocumentoPF->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objDocumentoPF = new DocumentoPF($row->id, $row->tipo, $row->numero, $row->dataemissao, $row->orgaoemissor, $row->via, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
		}

		return $this->objDocumentoPF;
	}

	/*-- Listar Todos --*/
	function listarTodos(DocumentoPF $objDocumentoPF){
		$this->sql = "SELECT * FROM documentopf";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();

			$this->objDocumentoPF = new DocumentoPF($row->id, $row->tipo, $row->numero, $row->dataemissao, $row->orgaoemissor, $row->via, $objPessoaFisica, $row->datacadastro, $row->dataedicao);

			array_push($this->listaDocumentoPF, $this->objDocumentoPF);
		}

		return $this->listaDocumentoPF;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorPessoaFisica($idpessoafisica){
		$this->sql = "SELECT * FROM documentopf WHERE idpessoafisica = $idpessoafisica";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
	
			$this->objDocumentoPF = new DocumentoPF($row->id, $row->tipo, $row->numero, $row->dataemissao, $row->orgaoemissor, $row->via, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaDocumentoPF, $this->objDocumentoPF);
		}
	
		return $this->listaDocumentoPF;
	}

	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM documentopf limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM documentopf";
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