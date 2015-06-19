<?php
require_once 'Perfil.php';

class PerfilDAO {
	private $con;
	private $sql;
	private $o_perfil;
	private $lista = array();
	
	function __construct($con){
		$this->con = $con;
	}
	
	function cadastrar(Perfil $o_perfil){	
		
		$this->sql = sprintf("INSERT INTO perfil (nome, ativo, datacadastrado, dataedicao) VALUES ('%s', %d, '%s', '%s')",
				mysqli_real_escape_string($this->con, $o_perfil->getNome()),
				mysqli_real_escape_string($this->con, $o_perfil->getAtivo()),
				mysqli_real_escape_string($this->con, $o_perfil->getDatacadastrado()),
				mysqli_real_escape_string($this->con, $o_perfil->getDataedicao()));
		
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
		}
		return mysqli_insert_id($this->con);
	}
	
	function atualizar(Perfil $o_perfil){
		$this->sql = sprintf("UPDATE perfil SET nome= '%s', ativo=%d, dataedicao='%s' WHERE id=%d",
		mysqli_real_escape_string($this->con, $o_perfil->getNome()),
		mysqli_real_escape_string($this->con, $o_perfil->getAtivo()),
		mysqli_real_escape_string($this->con, $o_perfil->getDataedicao()),
		mysqli_real_escape_string($this->con, $o_perfil->getId()));
		
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
		}
	}
	
	function deletar(Perfil $o_perfil){
		$id = $o_bairro->getId();
		$this->sql = "DELETE FROM PERFIL WHERE id='" . $id ."'" ;
		if (!mysqli_query($this->con, $this->sql)) {
			die('Error: ' . mysqli_error($this->con));
		}
	}
	
	function buscarPorId(Perfil $o_perfil){
		$id = $o_bairro->getId();
	
		$this->sql= "SELECT * FROM perfil WHERE id= '" . $id . "'";
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacadastrado, $row->dataedicao);
		}
	
		return $this->$o_perfil;
	}
	
	function listarTodos(){
		$this->sql= "SELECT * from perfil limit 50" ;
		$result = mysqli_query($this->con, $this->sql);
		if (!$result) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacadastrado, $row->dataedicao);
			
			$this->lista[] = $this->o_perfil;
		}

		return $this->lista;
	}
	
	function listarPorNome(Perfil $o_perfil){
		$this->sql= "SELECT * FROM perfil WHERE nome like '" . $o_perfil->getNome() . "%'" ;
		$result = mysqli_query($this->con, $this->sql);
		if (!$st_query) {
			die('Error: ' . mysqli_error($this->con));
		}
		while($row = mysqli_fetch_object($result)){
			
			$this->o_perfil = new Perfil($row->id, $row->nome, $row->ativo, $row->datacastrado, $row->dataedicao);
			
			$this->lista[] = $this->o_perfil;
		}

		return $this->v_o_perfil;
	}
}
