<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/OperadoraContatoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/operadoracontato/OperadoraContato.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaOperadoraContato();
			break;
	
		case 'POST':
			cadastraOperadoraContato();
			break;
	
		case 'PUT':
			atualizaOperadoraContato();
			break;
				
		case 'DELETE':
			deletaOperadoraContato();
			break;
}
	
function listaOperadoraContato() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objOperadoraContatoControl = new OperadoraContatoControl();
	$listaOperadoraContato = $objOperadoraContatoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaOperadoraContato as $objOperadoraContato) {
		$v_registros[] = $objOperadoraContato;
	}
	
	$objOperadoraContatoControl = new OperadoraContatoControl();
	$totalRegistro = $objOperadoraContatoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraOperadoraContato() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
		
	$objOperadoraContato = new OperadoraContato();
	$objOperadoraContato->setNome($data->desscricao);
	
	$objOperadoraContatoControl = new OperadoraContatoControl($objOperadoraContato);
	$id = $objOperadoraContatoControl->cadastrar();
	
	$objOperadoraContato->setId($id);
	
	$jsonDepois = json_encode( $objOperadoraContato );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objOperadoraContato), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objOperadoraContato
	));
	
}

function atualizaOperadoraContato() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objOperadoraContato = new OperadoraContato($data->id, $data->desscricao, NULL, $datahora );
	
	$objOperadoraContatoControl = new OperadoraContatoControl($objOperadoraContato);

	$jsonAntes = json_encode( $objOperadoraContatoControl->BuscarPorID() );
	
	$jsonDepois = json_encode( $objOperadoraContato );

	$objOperadoraContatoControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objOperadoraContato), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaOperadoraContato() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

// 	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objOperadoraContato = new OperadoraContato();
	$objOperadoraContato->setId($id);
	
	$objOperadoraContatoControl = new OperadoraContatoControl($objOperadoraContato);

	$jsonAntes = json_encode( $objOperadoraContatoControl->BuscarPorID() );
	$jsonDepois = $jsonAntes;
	$objOperadoraContatoControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objOperadoraContato), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>