<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaLocalidade();
			break;
	
		case 'POST':
			cadastraLocalidade();
			break;
	
		case 'PUT':
			atualizaLocalidade();
			break;
				
		case 'DELETE':
			deletaLocalidade();
			break;
}
	
function listaLocalidade() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$controller = new LocalidadeControl();
	$lista = $controller->listarPaginado($start, $limit);
	
	
	$totalRegistro = $controller->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $lista
	));
	
}

function cadastraLocalidade() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode($jsonDados);
	// Remover a mascara do CPF.
	$datacadastro = date("Y-m-d H:i:s");
	$dataedicao = date("Y-m-d H:i:s");
	
	$loc = new Localidade();
	$loc->setCodigoIBGE($data->codigoIBGE);
	$loc->setUf($data->uf);
	$loc->setCidade($data->cidade);
	$loc->setDatacadastro($datacadastro);
	$loc->setDataedicao($dataedicao);
	$loc->setObjPais(new Pais($data->idpais));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new LocalidadeControl($loc);
	$id = $controller->cadastrar();
	
	// RETORNA O id CADASTRADO PARA O OBJETO
	$loc->setId($id);
	
	echo json_encode(array(
			"success" => 0,
			"data" => array(
					'id' => $loc->getId())
	));
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $loc );
	$jsonAntes = $jsonDepois;
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($loc), $id, 'BASICO', 'INCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
			
}

function atualizaLocalidade() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
	
	$id = $data->id;
	
	$object = new Localidade();
	$object->setId($data->id);
	$object->setCodigoIBGE($data->codigoIBGE);
	$object->setUf($data->uf);
	$object->setCidade($data->cidade);	
	$object->setDataedicao(date("Y-m-d H:i:s"));
	$object->setObjPais(new Pais($data->idpais));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new LocalidadeControl($object);
	$antes = $controller->buscarPorId();
	$controller->atualizar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($antes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'MODERADO', 'ALTERAR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
}

function deletaLocalidade() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode($jsonDados);
		
	$id = $data->id;
	
	$object = new Localidade();
	$object->setId($id);
	$object->setCodigoIBGE($data->codigoIBGE);
	$object->setUf($data->uf);
	$object->setCidade($data->cidade);
	$object->setObjPais(new Pais($data->idpais));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$controller = new LocalidadeControl($object);
	$antes = $controller->buscarPorId();
	$result = $controller->deletar();
	
	/**		INICIO LOGSISTEMA	**/
	$jsonDepois = json_encode( $object );
	$jsonAntes = json_encode($antes);
	/*-- LogSistema      class -               ID -  NIVEL  -   AÇÃO  - ANTES - DEPOIS --*/
	CadastraLogSistema( get_class($object), $id, 'CRITICO', 'EXCLUIR', $jsonAntes, $jsonDepois);
	/**		FIM LOGSISTEMA	**/
	
	echo json_encode(array(
			"success" => $result,
	));
}

?>