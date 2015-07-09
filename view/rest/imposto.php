<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ImpostoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

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
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new ImpostoControl($object);
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
	$log->setOcorrencia('Inclusуo de registro na Classe Imposto.');
	$log->setNivel('BASICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
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
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new ImpostoControl($object);
	$controller->atualizar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Alteraчуo de registro na Classe Imposto.');
	$log->setNivel('MODERADO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

function deletaImposto() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	// INSERI O id NO OBJETO
	$object = new Imposto();
	$object->setId($id);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new ImpostoControl($object);
	$controller->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclusуo de registro na Classe Imposto.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

?>