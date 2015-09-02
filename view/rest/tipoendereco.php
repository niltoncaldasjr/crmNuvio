<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/TipoEnderecoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/tipoendereco/TipoEndereco.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaTipoEndereco();
			break;
	
		case 'POST':
			cadastraTipoEndereco();
			break;
	
		case 'PUT':
			atualizaTipoEndereco();
			break;
				
		case 'DELETE':
			deletaTipoEndereco();
			break;
}
	
function listaTipoEndereco() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objTipoEnderecoControl = new TipoEnderecoControl();
	$listaTipoEndereco = $objTipoEnderecoControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaTipoEndereco as $objTipoEndereco) {
		$v_registros[] = $objTipoEndereco;
	}
	
	$objTipoEnderecoControl = new TipoEnderecoControl();
	$totalRegistro = $objTipoEnderecoControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraTipoEndereco() {
	
	$jsonDados = $_POST['data'];

	$data = json_decode( $jsonDados );
		
	$objTipoEndereco = new TipoEndereco();
	$objTipoEndereco->setNome($data->desscricao);
	
	$objTipoEnderecoControl = new TipoEnderecoControl($objTipoEndereco);
	$id = $objTipoEnderecoControl->cadastrar();
	
	$objTipoEndereco->setId($id);
	
	$jsonDepois = json_encode( $objTipoEndereco );
	$jsonAntes = $jsonDepois;
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoEndereco), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objTipoEndereco
	));
	
}

function atualizaTipoEndereco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objTipoEndereco = new TipoEndereco($data->id, $data->desscricao, NULL, $datahora );
	
	$objTipoEnderecoControl = new TipoEnderecoControl($objTipoEndereco);

	$jsonAntes = json_encode( $objTipoEnderecoControl->BuscarPorID() );
	
	$jsonDepois = json_encode( $objTipoEndereco );

	$objTipoEnderecoControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoEndereco), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaTipoEndereco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

// 	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objTipoEndereco = new TipoEndereco();
	$objTipoEndereco->setId($id);
	
	$objTipoEnderecoControl = new TipoEnderecoControl($objTipoEndereco);

	$jsonAntes = json_encode( $objTipoEnderecoControl->BuscarPorID() );
	$jsonDepois = $jsonAntes;
	$objTipoEnderecoControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objTipoEndereco), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>