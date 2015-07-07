<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ContaBancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/contabanco/ContaBanco.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaContaBanco();
			break;
	
		case 'POST':
			cadastraContaBanco();
			break;
	
		case 'PUT':
			atualizaContaBanco();
			break;
				
		case 'DELETE':
			deletaContaBanco();
			break;
}
	
function listaContaBanco() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objContaContaBancoControl = new ContaBancoControl();
	$listaContaBanco = $objContaContaBancoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaContaBanco as $objContaBanco) {
		$v_registros[] = $objContaBanco;
	}
	
	$objContaContaBancoControl = new ContaBancoControl();
	$totalRegistro = $objContaContaBancoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraContaBanco() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$objContaBanco = new ContaBanco();
	$objContaBanco->setAgencia($data->agencia);
	$objContaBanco->setdigitoAgencia($data->digitoAgencia);
	$objContaBanco->setNumeroConta($data->numeroConta);
	$objContaBanco->setdigitoConta($data->digitoConta);
	$objContaBanco->setNumeroCarteira($data->numeroCarteira);
	$objContaBanco->setNumeroConvenio($data->numeroConvenio);
	$objContaBanco->setNomeContato($data->nomeContato);
	$objContaBanco->setTelefoneContato($data->telefoneContato);
	$objContaBanco->setObjBanco($data->banco);
	$objContaBanco->setObjEmpresa($data->empresa);
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$objContaBanco = $objContaContaBancoControl->cadastrar();
	
	//$objContaBanco->setId($objContaContaBancoControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objContaBanco
	));
	
}

function atualizaContaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$datahora = date("Y-m-d H:i:s");
	
	$objContaBanco = new ContaBanco();
	$objContaBanco->setAgencia($data->id);
	$objContaBanco->setAgencia($data->agencia);
	$objContaBanco->setdigitoAgencia($data->digitoAgencia);
	$objContaBanco->setNumeroConta($data->numeroConta);
	$objContaBanco->setdigitoConta($data->digitoConta);
	$objContaBanco->setNumeroCarteira($data->numeroCarteira);
	$objContaBanco->setNumeroConvenio($data->numeroConvenio);
	$objContaBanco->setNomeContato($data->nomeContato);
	$objContaBanco->setTelefoneContato($data->telefoneContato);
	$objContaBanco->setDataedicao($datahora);
	$objContaBanco->setObjBanco($data->banco);
	$objContaBanco->setObjEmpresa($data->empresa);
	
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$objContaContaBancoControl->atualizar();
	
}

function deletaContaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objContaBanco = new ContaBanco();
	$objContaBanco->setId($id);
	
	$objContaContaBancoControl = new ContaBancoControl($objContaBanco);
	$objContaContaBancoControl->deletar();
	
}

?>