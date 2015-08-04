<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/Logsistema.php';
	
	$object = new Empresa();
	$id = ($_POST['id']);
	$object->setNomeFantasia($_POST['nomeFantasia']);
	$object->setRazaoSocial($_POST['razaoSocial']);
	$object->setNomeReduzido($_POST['nomeReduzido']);
	$object->setCNPJ($_POST['CNPJ']);
	$object->setInscricaoEstadual($_POST['inscricaoEstadual']);
	$object->setInscricaoMunicipal($_POST['inscricaoMunicipal']);
	$object->setEndereco($_POST['endereco']);
	$object->setNumero($_POST['numero']);
	$object->setComplemento($_POST['complemento']);
	$object->setBairro($_POST['bairro']);
	$object->setCep($_POST['cep']);
	$object->setDataedicao(date('Y-m-d H:m:s'));
	$object->setObjLocalidade(new Localidade($_POST['idlocalidade']));
	$object->setObjImposto(new Imposto($_POST['idimposto']));
	
	$uploads_dir = $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'libs/uploads/';
	
	if ($id == ""){
		$id = 0;
	}
	if(isset($_FILES)){
		$tmpName = $_FILES['imagemLogotipo']['tmp_name'];
		$fileName = $_FILES['imagemLogotipo']['name'];
		move_uploaded_file($tmpName, "$uploads_dir/$fileName");
		
		$object->setImagemLogotipo($fileName);
	}
	if ($id ==  0) { //create
		// INSERI O OBJETO NO CONTROL 
		// E CHAMA O METODO CADASTRAR
		$controller = new EmpresaControl($object);
	 	$id = $controller->cadastrar();
		
		// RETORNA O id CADASTRADO PARA O OBJETO
	 	$object->setId($id);
	 	$lista = $object->jsonSerialize();
	
		// REGISTA O LOG NO SISTEMA
		$log = new LogSistema();
		$log->setOcorrencia('Inclusão de registro na Classe Empresa.');
		$log->setNivel('BASICO');
		$log->setObjUsuario(new Usuario($_SESSION['usuario']['idusuario']));
		$logController = new LogSistemaControl($log);
		$logController->cadastrar();
		header('Content-type: text/html');
		// encoda para formato JSON
		
	} else{
		$object->setId($id);
		if ($fileName != null) { // only update it if file upload
			$object->setImagemLogotipo($fileName) ;
		}
		$controller = new EmpresaControl($object);
		$controller->atualizar();
		$lista = $object->jsonSerialize();
	}
	
	echo json_encode(array(
			"success" => true,
			"data" => $lista));