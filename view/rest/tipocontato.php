<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/TipoContatoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/tipocontato/TipoContato.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaTipoContato();
			break;
	
		case 'POST':
			cadastraTipoContato();
			break;
	
		case 'PUT':
			atualizaTipoContato();
			break;
				
		case 'DELETE':
			deletaTipoContato();
			break;
}
	
function listaTipoContato() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objTipoContatoControl = new TipoContatoControl();
	$listaTipoContato = $objTipoContatoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaTipoContato as $objTipoContato) {
		$v_registros[] = $objTipoContato;
	}
	
	$objTipoContatoControl = new TipoContatoControl();
	$totalRegistro = $objTipoContatoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraTipoContato() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
		
	$objTipoContato = new TipoContato();
	$objTipoContato->setNome($data->desscricao);
	
	$objTipoContatoControl = new TipoContatoControl($objTipoContato);
	$id = $objTipoContatoControl->cadastrar();
	
	$objTipoContato->setId($id);
	
	$jsonDepois = json_encode( $objTipoContato );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoContato), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objTipoContato
	));
	
}

function atualizaTipoContato() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objTipoContato = new TipoContato($data->id, $data->desscricao, NULL, $datahora );
	
	$objTipoContatoControl = new TipoContatoControl($objTipoContato);

	$jsonAntes = json_encode( $objTipoContatoControl->BuscarPorID() );
	
	$jsonDepois = json_encode( $objTipoContato );

	$objTipoContatoControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoContato), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaTipoContato() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

// 	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objTipoContato = new TipoContato();
	$objTipoContato->setId($id);
	
	$objTipoContatoControl = new TipoContatoControl($objTipoContato);

	$jsonAntes = json_encode( $objTipoContatoControl->BuscarPorID() );
	$jsonDepois = $jsonAntes;
	$objTipoContatoControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoContato), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>