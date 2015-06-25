<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LeadControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/LeadDao.php';

/*-- Cadastrando Lead --*/
try{
	
	$objLead = new Lead();
	$objLead->setEmpresa('C&A');
	$objLead->setEmail('email@mail.com');
	$objLead->setTelefone('0000-0000');
	$objLead->setContato('Email, Telefone');
	$objLead->setAtivo(1);
	
	$objLeadControl = new LeadControl($objLead);
	$objLeadControl->cadastrar();
	echo "<font color='BLACK'>====================/- CADASTRO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLead->getEmpresa() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Buscar Lead --*/
try{
	$objLead = new Lead();
	$objLead->setId(1);
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->buscarPorID();
	
	echo "<font color='BLACK'>====================/- BUSCA POR ID -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO BUSCA! ". $objLead->getEmpresa() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Aleterar Lead --*/
try{
	$objLead = new Lead();
	$objLead->setId(2);
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->buscarPorID();
	$objLead->setEmpresa('Akto Corp');
	$objLead->setEmail('contato@akto.com');
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->atualizar();
	echo "<font color='BLACK'>====================/- ALTERACAO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO ALTERACAO! ". $objLead->getEmpresa() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Deletar Lead --*/
try{
	$objLead = new Lead();
	$objLead->setId(4);
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->deletar();
	
	echo "<font color='BLACK'>====================/- DELETE -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO DELETE! ". $objLead->getEmpresa() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Por Nome Lead --*/
try{
	$objLead = new Lead();
	$objLead->setEmpresa('Bemol');
	$objLeadControl = new LeadControl($objLead);
	$lista = $objLeadControl->listarPorNome();

	echo "<font color='BLACK'>====================/-LISTAR POR NOME -/=========================== </font></br>";
	foreach($lista as $objLead)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objLead->getEmpresa() ."</font></br>";
	}	
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Todas Leads --*/
try{
	$objLead = new Lead();
	$objLead->setEmpresa('Lead');
	$objLeadControl = new LeadControl($objLead);
	$lista = $objLeadControl->listarTodos();

	echo "<font color='BLACK'>====================/-LISTAR TODAS -/=========================== </font></br>";
	foreach($lista as $objLead)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objLead->getEmpresa() ."</font></br>";
	}
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}
?>
