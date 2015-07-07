<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/BancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/banco/Banco.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaBanco();
			break;
	
		case 'POST':
			cadastraBanco();
			break;
	
		case 'PUT':
			atualizaBanco();
			break;
				
		case 'DELETE':
			deletaBanco();
			break;
}
	
function listaBanco() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objBancoControl = new BancoControl();
	$listaBanco = $objBancoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaBanco as $objBanco) {
		$v_registros[] = $objBanco;
	}
	
	$objBancoControl = new BancoControl();
	$totalRegistro = $objBancoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraBanco() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$objBanco = new Banco();
	$objBanco->setNome($data->nome);
	$objBanco->setCodigoBancoCentral($data->codigoBancoCentral);
	
	$objBancoControl = new BancoControl($objBanco);
	$objBanco = $objBancoControl->cadastrar();
	
	//$objBanco->setId($objBancoControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objBanco
	));
	
}

function atualizaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$datahora = date("Y-m-d H:i:s");
	
	$objBanco = new Banco($data->id, $data->nome, $data->codigoBancoCentral, NULL, $datahora );
	
	$objBancoControl = new BancoControl($objBanco);
	$objBancoControl->atualizar();
	
}

function deletaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objBanco = new Banco();
	$objBanco->setId($id);
	
	$objBancoControl = new BancoControl($objBanco);
	$objBancoControl->deletar();
	
}

?>