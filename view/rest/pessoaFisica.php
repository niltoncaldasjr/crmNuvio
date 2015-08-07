<?php
/*-- Sessao --*/
session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/pessoafisica/PessoaFisica.php';
/*-- Log Sistema --*/
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" .'control/LogSistemaControl.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPessoaFisica();
			break;
	
		case 'POST':
			cadastraPessoaFisica();
			break;
	
		case 'PUT':
			atualizaPessoaFisica();
			break;
				
		case 'DELETE':
			deletaPessoaFisica();
			break;
}
	
function listaPessoaFisica() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$objPessoaFisicaControl = new PessoaFisicaControl();
	$listaPessoaFisica = $objPessoaFisicaControl->listarPaginado($start, $limit);
	
	$v_registros = array();
	
	foreach ($listaPessoaFisica as $objPessoaFisica) {
		$v_registros[] = $objPessoaFisica;
	}
	
	$objPessoaFisicaControl = new PessoaFisicaControl();
	$totalRegistro = $objPessoaFisicaControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraPessoaFisica() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	$cpf=$data->cpf;
	$cpf=preg_replace("/\D+/", "", $cpf); // remove qualquer caracter n�o num�rico
	
	$datanascimento = $data->datanascimento;
	
	$s_dataAniversario = substr($datanascimento,0,10);
	
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setNome($data->nome);
	$objPessoaFisica->setCpf($cpf);	
	$objPessoaFisica->setDatanascimento($s_dataAniversario);
	$objPessoaFisica->setEstadocivil($data->estadocivil);
	$objPessoaFisica->setSexo($data->sexo);
	$objPessoaFisica->setNomepai($data->nomepai);
	$objPessoaFisica->setNomemae($data->nomemae);
	$objPessoaFisica->setCor($data->cor);
	$objPessoaFisica->setNaturalidade($data->naturalidade);
	$objPessoaFisica->setNacionalidade($data->nacionalidade);
	
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisica = $objPessoaFisicaControl->cadastrar();
	
	//$objPessoaFisica->setId($objPessoaFisicaControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $objPessoaFisica
	));
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia('Inclus�o de registro na Classe Pessoa F�sica');
	$objLogSistema->setNivel('BASICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function atualizaPessoaFisica() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	$datahora = date("Y-m-d H:i:s");
	
	// Remover a mascara do CPF.
	$cpf=$data->cpf;
	$cpf=preg_replace("/\D+/", "", $cpf); // remove qualquer caracter n�o num�rico
	
	$datanascimento = $data->datanascimento;


	$s_dataAniversario = substr($datanascimento,0,10); 
	
	
	$objPessoaFisica = new PessoaFisica($data->id, $data->nome, $cpf, $s_dataAniversario, $data->estadocivil,
			$data->sexo,$data->nomepai, $data->nomemae, $data->cor, $data->naturalidade, $data->nacionalidade,NULL, $datahora );
	
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisicaControl->atualizar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia('Altera��o de registro na Classe Pessoa F�sica');
	$objLogSistema->setNivel('MODERADO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

function deletaPessoaFisica() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setId($id);
	
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisicaControl->deletar();
	
	// Resginstando Log do Sistema
	$objLogSistema = new LogSistema();
	$objLogSistema->setOcorrencia('Exclus�o de registro na Classe Rotina ID: '.$id);
	$objLogSistema->setNivel('CRITICO');
	$objLogSistema->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
	$objLogSistemaController = new LogSistemaControl($objLogSistema);
	$objLogSistemaController->cadastrar();
	
}

?>