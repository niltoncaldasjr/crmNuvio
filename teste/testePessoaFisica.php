<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisica.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pessoafisica/PessoaFisicaDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PessoaFisicaControl.php';

/*-- Cadastrando --*/
try{
	
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setNome('Manuel');
	$objPessoaFisica->setCpf('00011122200');
	$objPessoaFisica->setDatanascimento('2000-05-25');
	$objPessoaFisica->setEstadocivil('SOLTEIRO');
	$objPessoaFisica->setSexo('MASCULINO');
	$objPessoaFisica->setNomepai('Jao');
	$objPessoaFisica->setNomemae('Talita');
	$objPessoaFisica->setCor('BRANCA');
	$objPessoaFisica->setNaturalidade('Cearense');
	$objPessoaFisica->setNacionalidade('Brasileiro');
	
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$id = $objPessoaFisicaControl->cadastrar();
	echo "<font color='BLACK'>====================/- CADASTRO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO! ". $id ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Buscando --*/
try{
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setId(1);
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisica = $objPessoaFisicaControl->buscarPorID();
	
	echo "<font color='BLACK'>====================/- BUSCA POR ID -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO BUSCA! ". $objPessoaFisica->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Alterar PessoaFisica --*/
try{
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setId(2);
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisica = $objPessoaFisicaControl->buscarPorID();
	$objPessoaFisica->setNome('Renata Fernanda');
	$objPessoaFisica->setDataedicao('2015-06-22 17:00:00');
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisica = $objPessoaFisicaControl->atualizar();
	echo "<font color='BLACK'>====================/- ALTERACAO -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO ALTERACAO! ". $objPessoaFisica->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Deletar PessoaFisica --*/
try{
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setId(4);
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$objPessoaFisica = $objPessoaFisicaControl->deletar();
	
	echo "<font color='BLACK'>====================/- DELETE -/=========================== </font></br>";
	echo "<font color='BLUE'>[INFO]: SUCESSO DELETE! ". $objPessoaFisica->getNome() ."</font></br>";
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Listar Por Nome PessoaFisica --*/
try{
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setNome('Renata');
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$lista = $objPessoaFisicaControl->listarPorNome();

	echo "<font color='BLACK'>====================/-LISTAR POR NOME -/=========================== </font></br>";
	foreach($lista as $objPessoaFisica)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objPessoaFisica->getNome() ."</font></br>";
	}	
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}

/*-- Litar Todas PessoaFisicas --*/
try{
	$objPessoaFisica = new PessoaFisica();
	$objPessoaFisica->setNome('PessoaFisica');
	$objPessoaFisicaControl = new PessoaFisicaControl($objPessoaFisica);
	$lista = $objPessoaFisicaControl->listarTodos();

	echo "<font color='BLACK'>====================/-LISTAR TODAS -/=========================== </font></br>";
	foreach($lista as $objPessoaFisica)
	{
		echo "<font color='BLUE'>[INFO]: SUCESSO LISTAR POR NOME! ". $objPessoaFisica->getNome() ."</font></br>";
	}
}catch(Exception $e){
	echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
}
?>
