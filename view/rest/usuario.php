<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilRotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuariorotina/UsuarioRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioRotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaUsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresausuario/EmpresaUsuario.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaUsuario();
			break;
	
		case 'POST':
			cadastraUsuario();
			break;
	
		case 'PUT':
			atualizaUsuario();
			break;
				
		case 'DELETE':
			deletaUsuario();
			break;
}
	
function listaUsuario() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$controller = new UsuarioControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function cadastraUsuario() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode($jsonDados);
	
	$object = new Usuario();
	$object->setNome($data->nome);
	$object->setUsuario($data->usuario);
	$object->setSenha($data->senha);
	$object->setEmail($data->email);
	$object->setAtivo($data->ativo);
	$object->setObjPerfil(new Perfil($data->idperfil));
	$object->setObjPessoafisica(new PessoaFisica($data->idpessoafisica));	
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new UsuarioControl($object);
	$id = $controller->cadastrar();
	
	
	// RETORNA O id CADASTRADO PARA O OBJETO
	$object->setId($id);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => array('id' => $id)
	));
	
	/** 	INICIO PERMISSOES   **/
	// pegar todos as permissoes pra esse idperfil	
	$perfilrotina = new PerfilRotina(null,null,null,$object->getObjPerfil());
	$perfilrotinaControl = new PerfilRotinaControl($perfilrotina);
	$permissoes = $perfilrotinaControl->listarPorPerfil();	
	
	// copiar as permissoes para usuariorotina
	foreach ($permissoes as $cada){
		$objRotina = new Rotina($cada->idrotina);
		$usuariorotina = new UsuarioRotina(null,null,$objRotina,$object);
		$urControl = new UsuarioRotinaControl($usuariorotina);
		$id_ur = $urControl->cadastrar();
	}
	/** 	FIM PERMISSOES   **/	
	/**		INICIO ADICIONAR EMPRESAUSUARIO		**/
	$empresa = new Empresa($_SESSION['empresa']['idempresa']);
	$emp_usu = new EmpresaUsuario(null, $empresa, $object);
	$emp_usuControl = new EmpresaUsuarioControl($emp_usu);
	$emp_usuControl->cadastrar();	
	/**		FIM ADICIONAR EMPRESAUSUARIO		**/	
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = $jsonDepois;
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
}

function atualizaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
	
	$id = $data->id;
	
	$object = new Usuario();
	$object->setId($data->id);
	$object->setNome($data->nome);
	$object->setUsuario($data->usuario);
	$object->setSenha($data->senha);
	$object->setEmail($data->email);
	$object->setAtivo($data->ativo);
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$object->setObjPerfil(new Perfil($data->idperfil));
	$object->setObjPessoafisica(new PessoaFisica($data->idpessoafisica));
	
	// procura
	$controller = new UsuarioControl($object);
	$usuarioAntes = $controller->buscarPorId();
	
	// verifica se houve mudanças de perfil
	if ( $usuarioAntes->getObjPerfil()->getId() != $object->getObjPerfil()->getId() ){
		/** 	INICIO alterar PERMISSOES   **/
		// pegar todos as permissoes pra esse idperfil
		$perfilrotina = new PerfilRotina(null,null,null,$object->getObjPerfil());
		$perfilrotinaControl = new PerfilRotinaControl($perfilrotina);
		$permissoes = $perfilrotinaControl->listarPorPerfil();
		
		// deleta todas as permissoes antigas
		$rotinasDoUsuario = new UsuarioRotina(null,null,null,$object);
		$deletaRotinas = new UsuarioRotinaControl($rotinasDoUsuario);
		$deletaRotinas->deletarRotinasDoUsuario();
		
		// copiar as novas permissoes para usuariorotina
		foreach ($permissoes as $cada){
			$objRotina = new Rotina($cada->idrotina);
			$usuariorotina = new UsuarioRotina(null,null,$objRotina,$object);
			$urControl = new UsuarioRotinaControl($usuariorotina);
			$urControl->cadastrar();
		}		
		/** 	FIM PERMISSOES   **/
	}
	
	// E CHAMA O METODO ATUALIZAR COM OS NOVOS DADOS	
	$controller->atualizar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($usuarioAntes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
}

function deletaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
		
	$id = $data->id;
	
	$object = new Usuario();
	$object->setId($id);
	$object->setNome($data->nome);
	$object->setUsuario($data->usuario);
	$object->setSenha($data->senha);
	$object->setEmail($data->email);
	$object->setAtivo($data->ativo);
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$object->setObjPerfil(new Perfil($data->idperfil));
	$object->setObjPessoafisica(new PessoaFisica($data->idpessoafisica));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new UsuarioControl($object);
	$usuarioAntes = $controller->buscarPorId();
	$controller->deletar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($usuarioAntes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
}

?>