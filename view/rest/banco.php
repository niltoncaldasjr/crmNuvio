<?php
/*-- Sessao --*/
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/BancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/banco/Banco.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

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

	$data = json_decode( $jsonDados );
		
	$objBanco = new Banco();
	$objBanco->setNome($data->nome);
	$objBanco->setCodigoBancoCentral($data->codigoBancoCentral);
	
	$objBancoControl = new BancoControl($objBanco);
	$id = $objBancoControl->cadastrar();
	
	$objBanco->setId($id);
	
	$jsonDepois = json_encode( $objBanco );
	$jsonAntes = $jsonDepois;
	
	var_dump( json_encode( $objBanco ) );
	
	
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objBanco), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objBanco
	));
	
}

function atualizaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode( $jsonDados );

	$jsonDepois = json_encode( $data );
	
	$datahora = date("Y-m-d H:i:s");
	
	$objBanco = new Banco($data->id, $data->nome, $data->codigoBancoCentral, NULL, $datahora );
	
	$objBancoControl = new BancoControl($objBanco);

	$jsonAntes = json_encode( $objBancoControl->BuscarPorID() );

	$objBancoControl->atualizar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objBanco), $data->id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	
}

function deletaBanco() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));

	$jsonDepois = json_encode( $data );
		
	$id = $data->id;
	
	$objBanco = new Banco();
	$objBanco->setId($id);
	
	$objBancoControl = new BancoControl($objBanco);

	$jsonAntes = json_encode( $objBancoControl->BuscarPorID() );

	$objBancoControl->deletar();
	
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($objBanco), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	
}

?>