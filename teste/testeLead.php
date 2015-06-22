<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LeadControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/LeadDao.php';

/*-- Cadastrando Lead --*/
try{
	
	$objLead = new Lead();
	$objLead->setEmpresa('Ultimo Teste');
	$objLead->setDescricao('Teste Final');
	$objLead->setOrdem(1);
	$objLead->setUrl('www.com');
	$objLead->setAtivo(1);
	$objLead->setDatacadastro('2015/06/18 14:00:00');
	$objLead->setDataedicao('2015/06/18 14:00:00');
	
	$objLeadControl = new LeadControl($objLead);
	$objLeadControl->cadastrar();
	echo "<font color='BLACK'>====================/- CADASTRO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLead->getNome() ."</font></br>";
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
	echo "<font color='BLUE'>[INFO]: SUCESSO BUSCA! ". $objLead->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Aleterar Lead --*/
try{
	$objLead = new Lead();
	$objLead->setId(2);
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->buscarPorID();
	$objLead->setNome('Lead Alterado');
	$objLead->setDescricao('Esta Lead foi alterada');
	$objLeadControl = new LeadControl($objLead);
	$objLead = $objLeadControl->atualizar();
	echo "<font color='BLACK'>====================/- ALTERACAO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO ALTERACAO! ". $objLead->getNome() ."</font></br>";
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
	echo "<font color='BLUE'>[INFO]: SUCESSO DELETE! ". $objLead->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Por Nome Lead --*/
try{
	$objLead = new Lead();
	$objLead->setNome('Lead');
	$objLeadControl = new LeadControl($objLead);
	$lista = $objLeadControl->listarPorNome();

	echo "<font color='BLACK'>====================/-LISTAR POR NOME -/=========================== </font></br>";
	foreach($lista as $objLead)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objLead->getNome() ."</font></br>";
	}	
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Todas Leads --*/
try{
	$objLead = new Lead();
	$objLead->setNome('Lead');
	$objLeadControl = new LeadControl($objLead);
	$lista = $objLeadControl->listarTodos();

	echo "<font color='BLACK'>====================/-LISTAR TODAS -/=========================== </font></br>";
	echo "<font color='BLACK'>====================/-LISTAR TODAS -/=========================== </font></br>";
	foreach($lista as $objLead)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objLead->getNome() ."</font></br>";
	}
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}
?>
