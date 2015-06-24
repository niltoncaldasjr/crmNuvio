<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Banco/Banco.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/BancoControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/Banco/BancoDao.php';


/*-- Lista de Perfil Banco --*/
$objBanco = new Banco(null);
$objBancoControl = new BancoControl($objBanco);
$listaBanco = $objBancoControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando Banco</h1>
	<form action="" method="post">
		Nome:
		<input type='text' name="nome"/>
		Codico Banco Central:
		<input type='text' name="codigobancocentral"/>
		Login:
		<input type='text' name="login"/>
		DataSis:
		<input type='text' name="datasis"/>
		
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando Banco por ID</h1>
	Banco:
	<form action="" method="post">
		<select id='banco' name='banco'>
			<option value='0'>Selecione o Banco</option>
			<?php 
			foreach ($listaBanco as $Banco)
			{
				?>
				<option value='<?php echo $Banco->getId() ?>'> <?php echo $Banco->getNome() ?></option>
				<?php
			}
			?>
		</select>
		
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando Banco</h1>
	Banco:
	<form action="" method="post">
		<select id='banco' name='banco'>
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
		Nome:
		<input type='text' name="nome"/>
		Codico Banco Central:
		<input type='text' name="codigobancocentral"/>
		Login:
		<input type='text' name="login"/>
		DataSis:
		<input type='text' name="datasis"/>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando Banco</h1>
	<form action="" method="post">
		<select id='banco' name='banco'>
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
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando Todos Bancos</h1>
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
		$objBanco = new Banco();
		$objBanco->setNome($_POST['nome']);
		$objBanco->setCodigoBancoCentral($_POST['codigobancocentral']);
		$objBanco->setLogin($_POST['login']);
		$objBanco->setDatasis($_POST['datasis']);
		$objBancoControl = new BancoControl($objBanco);
		$objBanco = $objBancoControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objBanco->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objBanco = new Banco($_POST['banco']);
		$objBancoControl = new BancoControl($objBanco);
		$objBanco = $objBancoControl->buscarPorID();

		echo "</br><font color='BLACK'> >>> BUSCANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objBanco->toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		
		$objBanco = new Banco();
		$objBanco->setId($_POST['banco']);
		$objBanco->setNome($_POST['nome']);
		$objBanco->setCodigoBancoCentral($_POST['codigobancocentral']);
		$objBanco->setLogin($_POST['login']);
		$objBanco->setDatasis($_POST['datasis']);
		
		$objBancoControl = new BancoControl($objBanco);
		$objBanco = $objBancoControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objBanco->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objBanco = new Banco($_POST['banco']);
		$objBancoControl = new BancoControl($objBanco);
		$objBanco = $objBancoControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objBanco->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objBanco = new Banco(null);
		$objBancoControl = new BancoControl($objBanco);
		$lista = $objBancoControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objBanco){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objBanco->toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
