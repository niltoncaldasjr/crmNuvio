<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contaBanco/ContaBanco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ContaBancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contaBanco/ContaBancoDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Banco/Banco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/BancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';

/*-- Lista de Banco --*/
$objBanco = new Banco(null);
$objBancoControl = new BancoControl($objBanco);
$listaBanco = $objBancoControl->listarTodos();

/*-- Lista de Empresa --*/
$objEmpresa = new Empresa(null);
$objEmpresaControl = new EmpresaControl($objEmpresa);
$listaEmpresa = $objEmpresaControl->listarTodos();

/*-- Lista de Contato Banco--*/
$objContaBanco = new ContaBanco(null);
$objContaBancoControl = new ContaBancoControl($objContaBanco);
$listaContaBanco = $objContaBancoControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando ContaBanco</h1>
	<form action="" method="post">
		Agencia: <input type="text" name="agencia"/>
		Dig.Agencia: <input type="text" name="digitoAgencia"/>
		N.Conta: <input type="text" name="numeroConta"/>
		Dig.Conta: <input type="text" name="digitoConta"/>
		N.Carteira: <input type="text" name="numeroCarteira"/>
		N.Convenio: <input type="text" name="numeroConvenio"/>
		NomeCont:<input type="text" name="nomeContato">
		Tel.Cont:<input type="text" name="telefoneContato">
		Banco:
		<select id='Banco' name='Banco'>
			<option value='0'>Selecione o Banco</option>
			<?php 
			foreach ($listaBanco as $Banco)
			{
				?>
				<option value='<?php echo $Banco->getId() ?>'><?php echo $Banco->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		Empresa:
		<select id='Empresa' name='Empresa'>
			<option value='0'>Selecione a Empresa</option>
			<?php 
			foreach ($listaEmpresa as $Empresa)
			{
				?>
				<option value='<?php echo $Empresa->getId() ?>'><?php echo $Empresa->getNomeReduzido() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando ContaBanco por ID</h1>
	ContaBanco:
	<form action="" method="post">
		<select id='ContaBanco' name='ContaBanco'>
			<option value='0'>Selecione a ContaBanco</option>
			<?php 
			foreach ($listaContaBanco as $ContaBanco)
			{
				?>
				<option value='<?php echo $ContaBanco->getId() ?>'>Conta: <?php echo $ContaBanco->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando ContaBanco</h1>
	contaBanco:
	<form action="" method="post">
		<select id='ContaBanco' name='ContaBanco'>
			<option value='0'>Selecione o ContaBanco</option>
			<?php 
			foreach ($listaContaBanco as $ContaBanco)
			{
				?>
				<option value='<?php echo $ContaBanco->getId() ?>'>Conta: <?php echo $ContaBanco->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		Agencia: <input type="text" name="agencia"/>
		Dig.Agencia: <input type="text" name="digitoAgencia"/>
		N.Conta: <input type="text" name="numeroConta"/>
		Dig.Conta: <input type="text" name="digitoConta"/>
		N.Carteira: <input type="text" name="numeroCarteira"/>
		N.Convenio: <input type="text" name="numeroConvenio"/>
		NomeCont:<input type="text" name="nomeContato">
		Tel.Cont:<input type="text" name="telefoneContato">
		DataEdicao: <input type="text" name="dataedicao">
		Banco:
		<select id='Banco' name='Banco'>
			<option value='0'>Selecione o Banco</option>
			<?php 
			foreach ($listaBanco as $Banco)
			{
				?>
				<option value='<?php echo $Banco->getId() ?>'><?php echo $Banco->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		Empresa:
		<select id='Empresa' name='Empresa'>
			<option value='0'>Selecione a Empresa</option>
			<?php 
			foreach ($listaEmpresa as $Empresa)
			{
				?>
				<option value='<?php echo $Empresa->getId() ?>'><?php echo $Empresa->getNomeReduzido() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando contaBanco</h1>
	<form action="" method="post">
		<select id='ContaBanco' name='ContaBanco'>
			<option value='0'>Selecione o Banco</option>
			<?php 
			foreach ($listaContaBanco as $ContaBanco)
			{
				?>
				<option value='<?php echo $ContaBanco->getId() ?>'>Conta: <?php echo $ContaBanco->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando Todos ContaBanco</h1>
	<form action="" method="post">
	Listar todos:
	<input type="submit" id="listar" name="listar" value="listar">
	</form>

	______________________________________________________________________________________________________________________
</body>
</html>

<?php
/*-- Cadastrar --*/
if(isset($_POST['cadastrar']))
{
	try{
		$objEmpresa = new Empresa($_POST['Empresa']);
		$objBanco = new Banco($_POST['Banco']);
		$objContaBanco = new ContaBanco();
		$objContaBanco->setAgencia($_POST['agencia']);
		$objContaBanco->setDigitoAgencia($_POST['digitoAgencia']);
		$objContaBanco->setNumeroConta($_POST['numeroConta']);
		$objContaBanco->setDigitoConta($_POST['digitoConta']);
		$objContaBanco->setNumeroCarteira($_POST['numeroCarteira']);
		$objContaBanco->setNumeroConvenio($_POST['numeroConvenio']);
		$objContaBanco->setNomeContato($_POST['nomeContato']);
		$objContaBanco->setTelefoneContato($_POST['telefoneContato']);
		$objContaBanco->setObjBanco($objBanco);
		$objContaBanco->setObjEmpresa($objEmpresa);
		
		$objContaBancoControl = new ContaBancoControl($objContaBanco);
		$objContaBanco = $objContaBancoControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContaBanco->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objContaBanco = new ContaBanco($_POST['ContaBanco']);
		$objContaBancoControl = new ContaBancoControl($objContaBanco);
		$objContaBanco = $objContaBancoControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContaBanco->__toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objEmpresa = new Empresa($_POST['Empresa']);
		$objBanco = new Banco($_POST['Banco']);
		
		$objContaBanco = new ContaBanco($_POST['ContaBanco']);
		$objContaBanco->setAgencia($_POST['agencia']);
		$objContaBanco->setdigitoAgencia($_POST['digitoAgencia']);
		$objContaBanco->setNumeroConta($_POST['numeroConta']);
		$objContaBanco->setDigitoConta($_POST['digitoConta']);
		$objContaBanco->setNumeroCarteira($_POST['numeroCarteira']);
		$objContaBanco->setNumeroConvenio($_POST['numeroConvenio']);
		$objContaBanco->setNomeContato($_POST['nomeContato']);
		$objContaBanco->setTelefoneContato($_POST['telefoneContato']);
		$objContaBanco->setDataedicao($_POST['dataedicao']);
		$objContaBanco->setObjBanco($objBanco);
		$objContaBanco->setObjEmpresa($objEmpresa);
		
		
		$objContaBancoControl = new ContaBancoControl($objContaBanco);
		$objContaBanco = $objContaBancoControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContaBanco->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objContaBanco = new ContaBanco($_POST['ContaBanco']);
		$objContaBancoControl = new ContaBancoControl($objContaBanco);
		$objContaBanco = $objContaBancoControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContaBanco->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objContaBanco = new ContaBanco(null);
		$objContaBancoControl = new ContaBancoControl($objContaBanco);
		$lista = $objContaBancoControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objContaBanco){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContaBanco->__toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
