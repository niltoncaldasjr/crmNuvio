<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/RotinaDao.php';

/*-- Cadastrando Rotina --*/
echo "<h1>Cadastrando A Rotina</h1></br>";
//$datahora = date("Y-m-d H:i:s");

try{
	
	$objRotina = new Rotina();
	$objRotina->setNome('Teste Rotina');
	$objRotina->setDescricao('Teste 1');
	$objRotina->setOrdem(1);
	$objRotina->setUrl('www.com');
	$objRotina->setAtivo(1);
	$objRotina->setDatacadastro('2015/06/18');
	$objRotina->setDataedicao('2015/06/18');
	
	echo "<font color='BLUE'>[INFO]: SUCESSO!</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]: $e->getMessage()</font></br>";
}

?>