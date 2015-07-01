<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';

class PessoaFisicaDAO{
	/*-- Propriedades --*/
	private $con;
	private $sql;
	private $objPessoaFisica;
	private $listaPessoaFisica = array();
	
	/*-- Construtor --*/
	function __construct($con)
	{
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(PessoaFisica $objPessoaFisica){
		$this->sql = sprintf("INSERT INTO pessoafisica (nome, cpf, datanascimento, estadocivil, sexo, nomepai, nomemae, cor, naturalidade, nacionalidade) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNome() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getCpf() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getDatanascimento() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getEstadocivil() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getSexo() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNomepai() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNomemae() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getCor() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNaturalidade() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNacionalidade() ));
		
	
		if(!mysqli_query($this->con, $this->sql)){
			die("<font color='RED'>[ERRO]: CadastrarDAO~~> ".mysqli_error($this->con)."</font>");
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(PessoaFisica $objPessoaFisica){
		$this->sql = sprintf("UPDATE pessoafisica SET nome = '%s', cpf = '%s', datanascimento = '%s', estadocivil = '%s', sexo = '%s', nomepai = '%s', nomemae = '%s', cor = '%s', naturalidade = '%s', nacionalidade = '%s', dataedicao = '%s' WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNome() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getCpf() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getDatanascimento() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getEstadocivil() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getSexo() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNomepai() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNomemae() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getCor() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNaturalidade() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNacionalidade() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: AtualizarDAO '.mysqli_error($this->con));
		}
		return $this->objPessoaFisica = $objPessoaFisica;
	}
	
	/*-- Deletar --*/
	function deletar(PessoaFisica $objPessoaFisica){
		$this->sql = sprintf("DELETE FROM pessoafisica WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objPessoaFisica = $objPessoaFisica;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(PessoaFisica $objPessoaFisica){
		$this->sql = sprintf("SELECT * FROM pessoafisica WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getId() ) );
	
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: BuscarPorIDDAO'.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$this->objPessoaFisica = new PessoaFisica($row->id, $row->nome, $row->cpf, $row->datanascimento, $row->estadocivil, $row->sexo, $row->nomepai, $row->nomemae, $row->cor, $row->naturalidade, $row->nacionalidade, $row->datacadastro, $row->dataedicao);
		}
	
		return $this->objPessoaFisica;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(PessoaFisica $objPessoaFisica){
		$this->sql = "SELECT * FROM pessoafisica";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: ListarTodosDAO '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			
			$this->objPessoaFisica = new PessoaFisica($row->id, $row->nome, $row->cpf, $row->datanascimento, $row->estadocivil, $row->sexo, $row->nomepai, $row->nomemae, $row->cor, $row->naturalidade, $row->nacionalidade, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaPessoaFisica, $this->objPessoaFisica);
		}
	
		return $this->listaPessoaFisica;
	}
	
	/*-- Listar Por Nome --*/
	function listarPorNome(PessoaFisica $objPessoaFisica){
		/*-- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE --*/
		$this->sql = sprintf("SELECT * FROM pessoafisica WHERE nome like '%s%s%s' ",
				mysqli_real_escape_string( $this->con, '%' ),
				mysqli_real_escape_string( $this->con, $objPessoaFisica->getNome() ),
				mysqli_real_escape_string( $this->con, '%' ) );
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: ListarPorNomeDAO'.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			
			$this->objPessoaFisica = new PessoaFisica($row->id, $row->nome, $row->cpf, $row->datanascimento, $row->estadocivil, $row->sexo, $row->nomepai, $row->nomemae, $row->cor, $row->naturalidade, $row->nacionalidade, $row->datacadastro, $row->dataedicao);
	
			array_push($this->listaPessoaFisica, $this->objPessoaFisica);
		}
	
		return $this->listaPessoaFisica;
	}
	
	/*-- listaPessoaFisicar paginado --*/
	function listaPessoaFisicarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM pessoafisica limit " . $start . ", " . $limit;
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
	
			$this->objPessoaFisica = new PessoaFisica($row->id, $row->nome, $row->cpf, $row->datanascimento, $row->estadocivil, $row->sexo, $row->nomepai, $row->nomemae, $row->cor, $row->naturalidade, $row->nacionalidade, $row->datacadastro, $row->dataedicao);
	
			$this->listaPessoaFisica[] = $this->objPessoaFisica;
		}
	
		return $this->listaPessoaFisica;
	}
	
	/*-- Quantidade Total --*/
	function qtdTotal() {
		$this->sql = "SELECT count(*) as quantidade FROM pessoafisica";
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