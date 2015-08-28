<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatopf/ContatoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';

class ContatoPFDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objContatoPF;
	private $listaContatoPF = array();

	function __construct($con){
		$this->con = $con;
	}

	/*-- Metodo Cadastrar --*/
	function cadastrar(ContatoPF $objContatoPF){
		$this->sql = sprintf("INSERT INTO contatopf (tipo, operadora, contato, idpessoafisica)
				VALUES('%s', '%s', '%s', %d)",
				mysqli_real_escape_string( $this->con, $objContatoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getOperadora() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getContato() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjPessoaFisica()->getId() ) );

		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}

		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}

	/*-- Metodo Atualizar --*/
	function atualizar(ContatoPF $objContatoPF){
		$this->sql = sprintf("UPDATE contatopf SET tipo = '%s', operadora = '%s', contato = '%s', idpessoafisica = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoPF->getTipo() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getOperadora() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getContato() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjPessoafisica()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContatoPF = $objContatoPF;
	}

	/*-- Deletar --*/
	function deletar(ContatoPF $objContatoPF){
		$this->sql = sprintf("DELETE FROM contatopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoPF->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContatoPF = $objContatoPF;
	}

	/*-- Buscar por ID --*/
	function buscarPorId(ContatoPF $objContatoPF){
		$this->sql = sprintf("SELECT * FROM contatopf WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoPF->getId() ) );

		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
				
			$this->objContatoPF = new ContatoPF($row->id, $row->tipo, $row->operadora, $row->contato, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
		}

		return $this->objContatoPF;
	}

	/*-- Listar Todos --*/
	function listarTodos(ContatoPF $objContatoPF){
		$this->sql = "SELECT * FROM contatoPF";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();

			$this->objContatoPF = new ContatoPF($row->id, $row->tipo, $row->operadora, $row->contato, $objPessoaFisica, $row->datacadastro, $row->dataedicao);

			array_push($this->listaContatoPF, $this->objContatoPF);
		}

		return $this->listaContatoPF;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorPessoaFisica($idpessoafisica){
		$this->sql = "SELECT * FROM contatopf WHERE idpessoafisica = $idpessoafisica";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objPessoaFisica = new PessoaFisica();
			$objPessoaFisica->setId($row->idpessoafisica);
			$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
			$objPessoaFisica = $objPessoaFisicaControl->buscarPorId();
	
			$this->objContatoPF = new ContatoPF($row->id, $row->tipo, $row->operadora, $row->contato, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaContatoPF, $this->objContatoPF);
		}
	
		return $this->listaContatoPF;
	}

	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM contatoPF limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM contatoPF";
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