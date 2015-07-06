<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ImpostoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaImposto();
			break;
	
		case 'POST':
			cadastraImposto();
			break;
	
		case 'PUT':
			atualizaImposto();
			break;
				
		case 'DELETE':
			deletaImposto();
			break;
}
	
function listaImposto() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$controller = new ImpostoControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function cadastraImposto() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$object = new Imposto();
	$object->setAliquotaICMS($data->aliquotaICMS);
	$object->setAliquotaPIS($data->aliquotaPIS);
	$object->setaliquotaCOFINS($data->aliquotaCOFINS);
	$object->setAliquotaCSLL($data->aliquotaCSLL);
	$object->setAliquotaISS($data->aliquotaISS);
	$object->setAliquotaIRPJ($data->aliquotaIRPJ);
	$controller = new ImpostoControl($object);
	$id = $controller->cadastrar();
	
	$object->setId($id);
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $object
	));
	
}

function atualizaImposto() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$object = new Imposto();
	$object->setId($data->id);
	$object->setAliquotaICMS($data->aliquotaICMS);
	$object->setAliquotaPIS($data->aliquotaPIS);
	$object->setaliquotaCOFINS($data->aliquotaCOFINS);
	$object->setAliquotaCSLL($data->aliquotaCSLL);
	$object->setAliquotaISS($data->aliquotaISS);
	$object->setAliquotaIRPJ($data->aliquotaIRPJ);
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$controller = new ImpostoControl($object);
	$controller->atualizar();
	echo "ok";
	
}

function deletaImposto() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$object = new Imposto();
	$object->setId($id);
	
	$controller = new ImpostoControl($object);
	$controller->deletar();
	
}

?>