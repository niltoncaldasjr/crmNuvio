<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/RotinaDao.php';

/*-- Cadastrando Rotina --*/
try{
	
	$objRotina = new Rotina();
	$objRotina->setNome('Ultimo Teste');
	$objRotina->setDescricao('Teste Final');
	$objRotina->setOrdem(1);
	$objRotina->setUrl('www.com');
	$objRotina->setAtivo(1);
	$objRotina->setDatacadastro('2015/06/18 14:00:00');
	$objRotina->setDataedicao('2015/06/18 14:00:00');
	
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotinaControl->cadastrar();
	echo "<font color='BLACK'>====================/- CADASTRO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objRotina->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Buscar Rotina --*/
try{
	$objRotina = new Rotina();
	$objRotina->setId(1);
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotina = $objRotinaControl->buscarPorID();
	
	echo "<font color='BLACK'>====================/- BUSCA POR ID -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO BUSCA! ". $objRotina->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Aleterar Rotina --*/
try{
	$objRotina = new Rotina();
	$objRotina->setId(2);
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotina = $objRotinaControl->buscarPorID();
	$objRotina->setNome('Rotina Alterado');
	$objRotina->setDescricao('Esta rotina foi alterada');
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotina = $objRotinaControl->atualizar();
	echo "<font color='BLACK'>====================/- ALTERACAO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO ALTERACAO! ". $objRotina->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Deletar Rotina --*/
try{
	$objRotina = new Rotina();
	$objRotina->setId(4);
	$objRotinaControl = new RotinaControl($objRotina);
	$objRotina = $objRotinaControl->deletar();
	
	echo "<font color='BLACK'>====================/- DELETE -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO DELETE! ". $objRotina->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Por Nome Rotina --*/
try{
	$objRotina = new Rotina();
	$objRotina->setNome('Rotina');
	$objRotinaControl = new RotinaControl($objRotina);
	$lista = $objRotinaControl->listarPorNome();

	echo "<font color='BLACK'>====================/-LISTAR POR NOME -/=========================== </font></br>";
	foreach($lista as $objRotina)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objRotina->getNome() ."</font></br>";
	}	
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Todas Rotinas --*/
try{
	$objRotina = new Rotina();
	$objRotina->setNome('Rotina');
	$objRotinaControl = new RotinaControl($objRotina);
	$lista = $objRotinaControl->listarTodos();

	echo "<font color='BLACK'>====================/-LISTAR TODAS -/=========================== </font></br>";
	foreach($lista as $objRotina)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objRotina->getNome() ."</font></br>";
	}
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}
?>
