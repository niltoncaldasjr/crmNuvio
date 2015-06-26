<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/usuario/Usuario.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/perfil/Perfil.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/crmNuvio/' . 'model/pessoafisica/PessoaFisica.php';

class UsuarioDAO {
	private $con;
	private $sql;
	private $o_usuario;
	private $lista = array ();
	function __construct($con) {
		$this->con = $con;
	}
	function cadastrar(Usuario $o_usuario) {
		$this->sql = sprintf ( "INSERT INTO usuario (nome, usuario, senha, email, ativo, idperfil, idpessoafisica) VALUES ('%s', '%s', '%s', '%s', %d, %d, %d)", 
				mysqli_real_escape_string ( $this->con, $o_usuario->getNome () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getUsuario () ),
				mysqli_real_escape_string ( $this->con, $o_usuario->getSenha () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getEmail () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getAtivo () ),  
				mysqli_real_escape_string ( $this->con, $o_usuario->getObjPerfil ()->getId () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getObjPessoafisica ()->getId () ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		return mysqli_insert_id ( $this->con );
	}
	function atualizar(Usuario $o_usuario) {
		$this->sql = sprintf ( "UPDATE usuario SET nome= '%s', usuario= '%s', senha= '%s', email= '%s', ativo=%d, dataedicao='%s', idperfil=%d WHERE id= %d", 
				mysqli_real_escape_string ( $this->con, $o_usuario->getNome () ), 				
				mysqli_real_escape_string ( $this->con, $o_usuario->getUsuario () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getSenha () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getEmail () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getAtivo () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getDataedicao () ), 
				mysqli_real_escape_string ( $this->con, $o_usuario->getObjPerfil ()->getId () ), 				
				mysqli_real_escape_string ( $this->con, $o_usuario->getId () ) );
		
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( 'Error: ' . mysqli_error ( $this->con ) );
		}
		
		// var_dump($o_usuario);
	}
	function deletar(Usuario $o_usuario) {
		$this->sql = sprintf ( "DELETE FROM usuario WHERE id = %d", mysqli_real_escape_string ( $this->con, $o_usuario->getId () ) );
		if (! mysqli_query ( $this->con, $this->sql )) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		return $o_usuario;
	}
	
	/* -- Buscar por ID -- */
	function buscarPorID(Usuario $o_usuario) {
		$this->sql = sprintf ( "SELECT * FROM usuario WHERE id = %d", mysqli_real_escape_string ( $this->con, $o_usuario->getId () ) );
		
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			// busca o perfil desse usuario
			$perfil = new Perfil ( $row->idperfil );
			$perfilControl = new PerfilControl ( $perfil );
			$perfil = $perfilControl->buscarPorId ();
			
			// busca a pessoafisica desse usuario
			$pessoafisica = new PessoaFisica ( $row->idpessoafisica );
			$pessoafisicaControl = new PessoaFisicaControl ( $pessoafisica );
			$pessoafisica = $pessoafisicaControl->buscarPorID ();
			
			$this->o_usuario = new Usuario ( $row->id, $row->nome, $row->usuario, $row->senha, $row->email, $row->ativo, $row->datacadastro, $row->dataedicao, $perfil, $pessoafisica );
		}
		
		return $this->o_usuario;
	}
	
	/* -- Listar Todos -- */
	function listarTodos() {
		$this->sql = "SELECT * FROM usuario";
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			// busca o perfil desse usuario
			$perfil = new Perfil ( $row->idperfil );
			$perfilControl = new PerfilControl ( $perfil );
			$perfil = $perfilControl->buscarPorId ();
			
			// busca a pessoafisica desse usuario
			$pessoafisica = new PessoaFisica ( $row->idpessoafisica );
			$pessoafisicaControl = new PessoaFisicaControl ( $pessoafisica );
			$pessoafisica = $pessoafisicaControl->buscarPorID ();
			
			$this->o_usuario = new Usuario ( $row->id, $row->nome, $row->usuario, $row->senha, $row->email, $row->ativo, $row->datacadastro, $row->dataedicao, $perfil, $pessoafisica );
			
			$this->lista [] = $this->o_usuario;
		}
		
		return $this->lista;
	}
	
	/* -- Listar Por Nome -- */
	function listarPorNome(Usuario $o_usuario) {
		/* -- SQL PASSANDO COM %s(String do sprtintf) o percente % do LIKE -- */
		$this->sql = sprintf ( "SELECT * FROM usuario WHERE nome like '%s%s%s' ", mysqli_real_escape_string ( $this->con, '%' ), mysqli_real_escape_string ( $this->con, $o_usuario->getNome () ), mysqli_real_escape_string ( $this->con, '%' ) );
		$result = mysqli_query ( $this->con, $this->sql );
		if (! $result) {
			die ( '[ERRO]: ' . mysqli_error ( $this->con ) );
		}
		while ( $row = mysqli_fetch_object ( $result ) ) {
			
			// busca o perfil desse usuario
			$perfil = new Perfil ( $row->idperfil );
			$perfilControl = new PerfilControl ( $perfil );
			$perfil = $perfilControl->buscarPorId ();
			
			// busca a pessoafisica desse usuario
			$pessoafisica = new PessoaFisica ( $row->idpessoafisica );
			$pessoafisicaControl = new PessoaFisicaControl ( $pessoafisica );
			$pessoafisica = $pessoafisicaControl->buscarPorID ();
			
			$this->o_usuario = new Usuario ( $row->id, $row->nome, $row->usuario, $row->senha, $row->email, $row->ativo, $row->datacadastro, $row->dataedicao, $perfil, $pessoafisica );
			
			$this->lista [] = $this->o_usuario;
		}
		
		return $this->lista;
	}
}

