<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PaisControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pais/Pais.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'view/php/LogSistema/Cadastrar.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPais();
			break;
	
		case 'POST':
			cadastraPais();
			break;
	
		case 'PUT':
			atualizaPais();
			break;
				
		case 'DELETE':
			deletaPais();
			break;
}
	
function listaPais() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$o_paisControl = new PaisControl();
	$v_o_pais = $o_paisControl->listarPaginado($start, $limit);
	

	$o_paisControl = new PaisControl();
	$totalRegistro = $o_paisControl->qtdTotal();	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_o_pais
	));
	
}

function cadastraPais() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode($jsonDados);
	// Remover a mascara do CPF.
// 	$datacadastro = date("Y-m-d H:i:s");
// 	$dataedicao = date("Y-m-d H:i:s");
	
	$o_pais = new Pais();
	$o_pais->setDescricao($data->descricao);
	$o_pais->setNacionalidade($data->nacionalidade);
// 	$o_pais->setDatacadastro($datacadastro);
// 	$o_pais->setDataedicao($dataedicao);
	
	$o_paisControl = new PaisControl($o_pais);
	$id = $o_paisControl->cadastrar();
	
	$o_pais->setId($id);
	
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $o_pais );
	$jsonAntes = $jsonDepois;
// 	var_dump($jsonDepois);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($o_pais), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
		
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $o_pais
	));
	
}

function atualizaPais() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
	$dataedicao = date("Y-m-d H:i:s");
	
	$o_pais = new Pais( $data->id, $data->descricao, $data->nacionalidade,NULL,$dataedicao);
	
	$o_paisControl = new PaisControl($o_pais);
	$o_paisControl->atualizar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Alteração de registro na Classe País.');
	$log->setNivel('MODERADO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

function deletaPais() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
		
	$id = $data->id;
	
	$o_pais = new Pais();
	$o_pais->setId($id);
	
	$o_paisControl = new PaisControl($o_pais);
	$o_paisControl->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclusão de registro na Classe País.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
	
}

?>