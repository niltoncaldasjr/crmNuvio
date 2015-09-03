<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatopf/ContatoPF.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/tipocontato/TipoContato.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/TipoContatoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/operadoracontato/OperadoraContato.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/OperadoraContatoControl.php';

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
		$this->sql = sprintf("INSERT INTO contatopf (idtipocontato, idoperadoracontato, contato, idpessoafisica)
				VALUES(%d, %d, '%s', %d)",
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjtipocontato()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjoperadoracontato()->getId() ),
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
		$this->sql = sprintf("UPDATE contatopf SET idtipocontato = %d, idoperadoracontato = %d, contato = '%s', idpessoafisica = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjtipocontato()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoPF->getObjoperadoracontato()->getId() ),
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
			
			$objTipoContato = new TipoContato();
			$objTipoContato->setId($row->idpessoafisica);
			$objTipoContatoControl = new TipoContatoControl($objTipoContato);
			$objTipoContato = $objTipoContatoControl->buscarPorId();
				
			$objOperadoraContato = new OperadoraContato();
			$objOperadoraContato->setId($row->idpessoafisica);
			$objOperadoraContatoControl = new OperadoraContatoControl($objOperadoraContato);
			$objOperadoraContato = $objOperadoraContatoControl->buscarPorId();
			
			$this->objContatoPF = new ContatoPF($row->id, $objTipoContato, $objOperadoraContato, $row->contato, $objPessoaFisica, $row->datacadastro, $row->dataedicao);
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

			$objTipoContato = new TipoContato();
			$objTipoContato->setId($row->idpessoafisica);
			$objTipoContatoControl = new TipoContatoControl($objTipoContato);
			$objTipoContato = $objTipoContatoControl->buscarPorId();
			
			$objOperadoraContato = new OperadoraContato();
			$objOperadoraContato->setId($row->idpessoafisica);
			$objOperadoraContatoControl = new OperadoraContatoControl($objOperadoraContato);
			$objOperadoraContato = $objOperadoraContatoControl->buscarPorId();
				
			$this->objContatoPF = new ContatoPF($row->id, $objTipoContato, $objOperadoraContato, $row->contato, $objPessoaFisica, $row->datacadastro, $row->dataedicao);

			array_push($this->listaContatoPF, $this->objContatoPF);
		}

		return $this->listaContatoPF;
	}
	
	/*-- Listar Por Pessoa Fisica --*/
	function listarPorPessoaFisica($idpessoafisica){
		$this->sql = "SELECT * FROM contatopf WHERE idpessoafisica = $idpessoafisica";
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