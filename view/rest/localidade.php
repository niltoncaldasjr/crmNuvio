<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/Localidade.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaLocalidade();
			break;
	
		case 'POST':
			cadastraLocalidade();
			break;
	
		case 'PUT':
			atualizaLocalidade();
			break;
				
		case 'DELETE':
			deletaLocalidade();
			break;
}
	
function listaLocalidade() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$controller = new LocalidadeControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function cadastraLocalidade() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$object = new Localidade();
	$object->setCodigoIBGE($data->codigoIBGE);
	$object->setUf($data->uf);
	$object->setCidade($data->cidade);
	$object->setObjPais(new Pais($data->idpais));
	$controller = new LocalidadeControl($object);
	$id = $controller->cadastrar();
	
	$object->setId($id);
	
	//var_dump($data);
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $object
	));
	
}

function atualizaLocalidade() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$object = new Localidade();
	$object->setId($data->id);
	$object->setCodigoIBGE($data->codigoIBGE);
	$object->setUf($data->uf);
	$object->setCidade($data->cidade);	
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$object->setObjPais(new Pais($data->idpais));
	$controller = new LocalidadeControl($object);
	$controller->atualizar();
	//var_dump($data);
	
}

function deletaLocalidade() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$object = new Localidade();
	$object->setId($id);
	
	$controller = new LocalidadeControl($object);
	$controller->deletar();
	
}

?>