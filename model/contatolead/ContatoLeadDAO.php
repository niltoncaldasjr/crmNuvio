<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatolead/ContatoLead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LeadControl.php';

class ContatoLeadDAO{
	/*-- Criando atributos da class --*/
	private $con;
	private $sql;
	private $objContatoLead;
	private $listaContatoLead = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	/*-- Metodo Cadastrar --*/
	function cadastrar(ContatoLead $objContatoLead){
		$this->sql = sprintf("INSERT INTO contatolead (datacontato, descricao, dataretorno, idusuario, idlead) 
				VALUES('%s', '%s', '%s', %d, %d)",
				mysqli_real_escape_string( $this->con, $objContatoLead->getDatacontato() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getDataretorno() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getObjLead()->getId() ) );
				
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO] Cadastro: '.mysqli_error($this->con));
		}
		
		/*-- Pegando ultimo obj cadastrado --*/
		return mysqli_insert_id ( $this->con );
	}
	
	/*-- Metodo Atualizar --*/
	function atualizar(ContatoLead $objContatoLead){
		$this->sql = sprintf("UPDATE contatolead SET datacontato = '%s', descricao = '%s', dataretorno = '%s', dataedicao = '%s', idusuario = %d, idlead = %d WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoLead->getDatacontato() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getDescricao() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getDataretorno() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getDataedicao() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getObjUsuario()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getObjLead()->getId() ),
				mysqli_real_escape_string( $this->con, $objContatoLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContatoLead = $objContatoLead;
	}
	
	/*-- Deletar --*/
	function deletar(ContatoLead $objContatoLead){
		$this->sql = sprintf("DELETE FROM contatolead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoLead->getId() ) );
		if(!mysqli_query($this->con, $this->sql)){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		return $this->objContatoLead = $objContatoLead;
	}
	
	/*-- Buscar por ID --*/
	function buscarPorId(ContatoLead $objContatoLead){
		$this->sql = sprintf("SELECT * FROM contatolead WHERE id = %d",
				mysqli_real_escape_string( $this->con, $objContatoLead->getId() ) );
		
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
			
			$objLead = new Lead();
			$objLead->setId($row->idlead);
			$objLeadControl = new LeadControl($objLead);
			$objLead = $objLeadControl->buscarPorId();
			
			$this->objContatoLead = new ContatoLead($row->id, $row->datacontato, $row->descricao, $row->dataretorno, $row->datacadastro, $row->dataedicao, $objUsuario, $objLead); 
		}
		
		return $this->objContatoLead;
	}
	
	/*-- Listar Todos --*/
	function listarTodos(ContatoLead $objContatoLead){
		$this->sql = "SELECT * FROM contatolead";
		$resultSet = mysqli_query($this->con, $this->sql);
		if(!$resultSet){
			die('[ERRO]: '.mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($resultSet)){
			$objUsuario = new Usuario();
			$objUsuario->setId($row->idusuario);
			$objUsuarioControl = new UsuarioControl($objUsuario);
			$objUsuario = $objUsuarioControl->buscarPorId();
				
			$objLead = new Lead();
			$objLead->setId($row->idlead);
			$objLeadControl = new LeadControl($objLead);
			$objLead = $objLeadControl->buscarPorId();
				
			$this->objContatoLead = new ContatoLead($row->id, $row->datacontato, $row->descricao, $row->dataretorno, $row->datacadastro, $row->dataedicao, $objUsuario, $objLead); 
				
			array_push($this->listaContatoLead, $this->objContatoLead);
		}
		
		return $this->listaContatoLead;
	}
	
	/*-- listaRotinar paginado --*/
	function listarPaginado($start, $limit) {
		$this->sql = "SELECT * FROM contatolead limit " . $start . ", " . $limit;
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
		$this->sql = "SELECT count(*) as quantidade FROM contatolead";
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