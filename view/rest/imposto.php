<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ImpostoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/imposto/Imposto.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

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
	$data = json_decode($jsonDados);
	// Remover a mascara do CPF.
	
	$object = new Imposto();
	$object->setTitulo($data->titulo);
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
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = $jsonDepois;
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
}

function atualizaImposto() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
	$id = $data->id;
	
	$object = new Imposto();
	$object->setId($data->id);
	$object->setTitulo($data->titulo);
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
	$antes = $controller->buscarPorId();
	$controller->atualizar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($antes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
}

function deletaImposto() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
		
	$id = $data->id;
	
	// INSERI O id NO OBJETO
	$object = new Imposto();
	$object->setId($id);
	$object->setTitulo($data->titulo);
	$object->setAliquotaICMS($data->aliquotaICMS);
	$object->setAliquotaPIS($data->aliquotaPIS);
	$object->setaliquotaCOFINS($data->aliquotaCOFINS);
	$object->setAliquotaCSLL($data->aliquotaCSLL);
	$object->setAliquotaISS($data->aliquotaISS);
	$object->setAliquotaIRPJ($data->aliquotaIRPJ);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new ImpostoControl($object);
	$antes = $controller->buscarPorId();
	$controller->deletar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($antes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
}

?>