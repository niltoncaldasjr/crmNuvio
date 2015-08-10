<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

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
	// Remover a mascara do CPF.
	
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
			"data" => $object
	));
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Inclusão de registro na Classe Usuario.');
	$log->setNivel('BASICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

function atualizaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
	
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
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new UsuarioControl($object);
	$controller->atualizar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Alteração de registro na Classe Usuario.');
	$log->setNivel('MODERADO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

function deletaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
		
	$id = $data->id;
	
	$object = new Usuario();
	$object->setId($id);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new UsuarioControl($object);
	$controller->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclusão de registro na Classe Usuario.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

?>