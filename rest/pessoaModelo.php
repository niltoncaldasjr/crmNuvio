<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/git/akto/cau/" . 'control/PessoaFisicaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/git/akto/cau/" .'model/bean/PessoaFisica.php';

switch ($_SERVER['REQUEST_METHOD']) {
	
		case 'GET':
			listaPessoa();
			break;
	
		case 'POST':
			cadastraPessoa();
			break;
	
		case 'PUT':
			atualizaPessoa();
			break;
				
		case 'DELETE':
			deletaPessoa();
			break;
}
	
function listaPessoa() {
	
	$start = $_REQUEST['start'];
	$limit = $_REQUEST['limit'];
	

	$o_pessoaFisicaControl = new PessoaFisicaControl();
	$v_o_pessoaFisica = $o_pessoaFisicaControl->listarPaginado($start, $limit);
	
	foreach ($v_o_pessoaFisica as $o_pessoaFisica) {
		$v_registros[] = $o_pessoaFisica;
	}
	
	$o_pessoaFisicaControl = new PessoaFisicaControl();
	$totalRegistro = $o_pessoaFisicaControl->qtdTotal();
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"total" => $totalRegistro,
			"data" => $v_registros
	));
	
}

function cadastraPessoa() {
	
	$jsonDados = $_POST['data'];
	$data = json_decode(stripslashes($jsonDados));
	// Remover a mascara do CPF.
	$cpf=$data->cpf;
	$cpf=preg_replace("/\D+/", "", $cpf); // remove qualquer caracter não numérico
	
	$datahora = date("Y-m-d H:i:s");
	// Tratar a Data
// 	$dat2 = explode('/', '09/17/1969');	
// 	$d_for = explode('/', '09/17/1969');
	$d_for = explode('/', '09/17/1969');
// 	$dat2 = $data->dataCadastro;
// 	$d_for = explode('/', $dat2);
	$dia = $d_for[1];
	$mes = $d_for[0];
	$ano = $d_for[2];
	$s_dataAniversario = $ano."-".$mes."-".$dia;
	
	$o_pessoaFisica = new PessoaFisica();
	$o_pessoaFisica->setNome($data->nome);
	$o_pessoaFisica->setCpf($cpf);	
	$o_pessoaFisica->setDataNascimento($s_dataAniversario);
	$o_pessoaFisica->setEnumEstadoCivil($data->enum_estadoCivil);
	$o_pessoaFisica->setEnumSexo($data->enum_sexo);
	$o_pessoaFisica->setNomePai($data->nomePai);
	$o_pessoaFisica->setNomeMae($data->nomeMae);
	$o_pessoaFisica->setEnumCor($data->enum_cor);
	$o_pessoaFisica->setNaturalidade($data->naturalidade);
	$o_pessoaFisica->setNacionalidade($data->nacionalidade);
	$o_pessoaFisica->setDataCadastro($datahora);
	$o_pessoaFisica->setDataAtualizacao($datahora);
	
	$o_pessoaFisicaControl = new PessoaFisicaControl($o_pessoaFisica);
	$o_pessoaFisicaControl->cadastrar();
	
	$o_pessoaFisica->setId($o_pessoaFisicaControl->getUltimoId());
	
	
	// encoda para formato JSON
	echo json_encode(array(
			"success" => 0,
			"data" => $o_pessoaFisica
	));
	
}

function atualizaPessoa() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
	
	// Remover a mascara do CPF.
	$cpf=$data->cpf;
	$cpf=preg_replace("/\D+/", "", $cpf); // remove qualquer caracter não numérico
	
// 	$datahora = date("Y-m-d H:i:s");
	$datahora = $data->dataNascimento;
// 	$datahora = '09/17/1969';
	// Tratar a Data
// 	$d_for = explode('/', '09/17/1969');
	$d_for = explode('/', $datahora);	
	$dia = $d_for[1];
	$mes = $d_for[0];
	$ano = $d_for[2];
	$s_dataAniversario = $ano."-".$mes."-".$dia;
	
	
	$o_pessoaFisica = new PessoaFisica($data->id, $data->nome, $cpf, $s_dataAniversario, $data->enum_estadoCivil,
			$data->enum_sexo,$data->nomePai, $data->nomeMae, $data->enum_cor, $data->naturalidade, $data->nacionalidade, $data,$data );
	
	$o_pessoaFisicaControl = new PessoaFisicaControl($o_pessoaFisica);
	$o_pessoaFisicaControl->atualizar();
	
}

function deletaPessoa() {
	
	parse_str(file_get_contents("php://input"), $post_vars);
	$jsonDados = $post_vars['data'];
	$data = json_decode(stripslashes($jsonDados));
		
	$id = $data->id;
	
	$o_pessoaFisica = new PessoaFisica();
	$o_pessoaFisica->setId($id);
	
	$o_pessoaFisicaControl = new PessoaFisicaControl($o_pessoaFisica);
	$o_pessoaFisicaControl->deletar();
	
}

?>