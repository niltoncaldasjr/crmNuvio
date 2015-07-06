<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Usuario/Usuario.php';

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
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$object = new Usuario();
	$object->setNome($data->nome);
	$object->setUsuario($data->usuario);
	$object->setSenha($data->senha);
	$object->setEmail($data->email);
	$object->setAtivo($data->ativo);
	$object->setObjPerfil(new Perfil($data->idperfil));
	$object->setObjPessoafisica(new PessoaFisica($data->idpessoafisica));
	$controller = new UsuarioControl($object);
	$id = $controller->cadastrar();
	
	$object->setId($id);
	
	//var_dump($data);
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $object
	));
	
}

function atualizaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
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
	$controller = new UsuarioControl($object);
	$controller->atualizar();
	//var_dump($data);
	
}

function deletaUsuario() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$object = new Usuario();
	$object->setId($id);
	
	$controller = new UsuarioControl($object);
	$controller->deletar();
	
}

?>