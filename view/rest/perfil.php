<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPerfil();
			break;
	
		case 'POST':
			cadastraPerfil();
			break;
	
		case 'PUT':
			atualizaPerfil();
			break;
				
		case 'DELETE':
			deletaPerfil();
			break;
}
	
function listaPerfil() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$o_perfilControl = new PerfilControl();
	$v_o_perfil = $o_perfilControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($v_o_perfil as $o_perfil) {
		$v_registros[] = $o_perfil;
	}
	
	$o_perfilControl = new PerfilControl();
	$totalRegistro = $o_perfilControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraPerfil() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	
	$o_perfil = new Perfil();
	$o_perfil->setId($data->id);
	$o_perfil->setNome($data->nome);	
	$o_perfil->setAtivo($data->ativo);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$o_perfilControl = new PerfilControl($o_perfil);
	$id = $o_perfilControl->cadastrar();
	
	// RETORNA O id CADASTRADO PARA O OBJETO
	$o_perfil->setId($id);
	
	//var_dump($o_perfil);
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $o_perfil
	));
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Inclus�o de registro na Classe Perfil.');
	$log->setNivel('BASICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

function atualizaPerfil() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$o_perfil = new Perfil();
	$o_perfil->setId($data->id);
	$o_perfil->setNome($data->nome);
	$o_perfil->setAtivo($data->ativo);
	$o_perfil->setDataedicao(date("Y-m-d H:i:s"));
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$o_perfilControl = new PerfilControl($o_perfil);
	$o_perfilControl->atualizar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Altera��o de registro na Classe Perfil.');
	$log->setNivel('MODERADO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

function deletaPerfil() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$o_perfil = new Perfil();
	$o_perfil->setId($id);
	
	// INSERI O OBJETO NO CONTROL
	// E CHAMA O METODO CADASTRAR
	$o_perfilControl = new PerfilControl($o_perfil);
	$o_perfilControl->deletar();
	
	// REGISTA O LOG NO SISTEMA
	$log = new LogSistema();
	$log->setOcorrencia('Exclus�o de registro na Classe Perfil.');
	$log->setNivel('CRITICO');
	$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$logController = new LogSistemaControl($log);
	$logController->cadastrar();
}

?>