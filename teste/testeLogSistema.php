<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/LogSistema.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LogSistemaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/logsistema/LogSistemaDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';

/*-- Lista de Usuario --*/
$objUsuario = new Usuario(null);
$objUsuarioControl = new UsuarioControl($objUsuario);
$listaUsuario = $objUsuarioControl->listarTodos();

/*-- Lista de Contato Usuario--*/
$objLogSistema = new LogSistema(null);
$objLogSistemaControl = new LogSistemaControl($objLogSistema);
$listaLogSistema = $objLogSistemaControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando LogSistema</h1>
	<form action="" method="post">
		Ocorrencia: <input type="text" name="ocorrencia"/>
		Nivel: 
		<select id='nivel' name='nivel'>
			<option value='0'>Selecione o Nivel</option>
			<option value='BASICO'>BASICO</option>
			<option value='MODERADO'>MODERADO</option>
			<option value='CRITICO'>CRITICO</option>
		</select>
		Usuario:
		<select id='Usuario' name='Usuario'>
			<option value='0'>Selecione o Usuario</option>
			<?php 
			foreach ($listaUsuario as $Usuario)
			{
				?>
				<option value='<?php echo $Usuario->getId() ?>'><?php echo $Usuario->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando LogSistema por ID</h1>
	LogSistema:
	<form action="" method="post">
		<select id='LogSistema' name='LogSistema'>
			<option value='0'>Selecione a LogSistema</option>
			<?php 
			foreach ($listaLogSistema as $LogSistema)
			{
				?>
				<option value='<?php echo $LogSistema->getId() ?>'>Conta: <?php echo $LogSistema->getOcorrencia() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando LogSistema</h1>
	LogSistema:
	<form action="" method="post">
		<select id='LogSistema' name='LogSistema'>
			<option value='0'>Selecione o LogSistema</option>
			<?php 
			foreach ($listaLogSistema as $LogSistema)
			{
				?>
				<option value='<?php echo $LogSistema->getId() ?>'>Conta: <?php echo $LogSistema->getOcorrencia() ?></option>
				<?php
			}
			?>
		</select>
		ocorrencia: <input type="text" name="ocorrencia"/>
		Nivel: 
		<select id='nivel' name='nivel'>
			<option value='0'>Selecione o Nivel</option>
			<option value='BASICO'>BASICO</option>
			<option value='MODERADO'>MODERADO</option>
			<option value='CRITICO'>CRITICO</option>
		</select>
		Usuario:
		<select id='Usuario' name='Usuario'>
			<option value='0'>Selecione o Usuario</option>
			<?php 
			foreach ($listaUsuario as $Usuario)
			{
				?>
				<option value='<?php echo $Usuario->getId() ?>'><?php echo $Usuario->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando LogSistema</h1>
	<form action="" method="post">
		<select id='LogSistema' name='LogSistema'>
			<option value='0'>Selecione o Usuario</option>
			<?php 
			foreach ($listaLogSistema as $LogSistema)
			{
				?>
				<option value='<?php echo $LogSistema->getId() ?>'>Conta: <?php echo $LogSistema->getOcorrencia() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando LogSistema Por Nivel</h1>
	<form action="" method="post">
	Listar:
	Nivel: 
	<select id='nivel' name='nivel'>
		<option value='0'>Selecione o Nivel</option>
		<option value='BASICO'>BASICO</option>
		<option value='MODERADO'>MODERADO</option>
		<option value='CRITICO'>CRITICO</option>
	</select>
	<input type="submit" id="listarPorNivel" name="listarPorNivel" value="listarPorNivel">
	</form>
	
	<h1>Listando LogSistema Por Usuario</h1>
	<form action="" method="post">
	Listar:
	Usuario:
	<select id='Usuario' name='Usuario'>
		<option value='0'>Selecione o Usuario</option>
		<?php 
		foreach ($listaUsuario as $Usuario)
		{
			?>
			<option value='<?php echo $Usuario->getId() ?>'><?php echo $Usuario->getNome() ?></option>
			<?php
		}
		?>
		
	</select>
	<input type="submit" id="listarPorUsuario" name="listarPorUsuario" value="listarPorUsuario">
	</form>
	
	<h1>Listando Todos LogSistema</h1>
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
		$objUsuario = new Usuario($_POST['Usuario']);
		$objLogSistema = new LogSistema();
		$objLogSistema->setocorrencia($_POST['ocorrencia']);
		$objLogSistema->setnivel($_POST['nivel']);
		$objLogSistema->setObjUsuario($objUsuario);
		
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$objLogSistema = $objLogSistemaControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objLogSistema = new LogSistema($_POST['LogSistema']);
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$objLogSistema = $objLogSistemaControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objUsuario = new Usuario($_POST['Usuario']);
		
		$objLogSistema = new LogSistema($_POST['LogSistema']);
		$objLogSistema->setocorrencia($_POST['ocorrencia']);
		$objLogSistema->setnivel($_POST['nivel']);
		$objLogSistema->setObjUsuario($objUsuario);
		
		
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$objLogSistema = $objLogSistemaControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objLogSistema = new LogSistema($_POST['LogSistema']);
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$objLogSistema = $objLogSistemaControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- ListarPorNivel --*/
if(isset($_POST['listarPorNivel']))
{
	try{
		$objLogSistema = new LogSistema(null);
		$objLogSistema->setNivel($_POST['nivel']);
		
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$lista = $objLogSistemaControl->listarPorNivel();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objLogSistema){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString()."</font></br>";
		}

	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- ListarPorUsuario --*/
if(isset($_POST['listarPorUsuario']))
{
	try{
		$objUsuario = new Usuario($_POST['Usuario']);
		$objLogSistema = new LogSistema(null);
		$objLogSistema->setObjUsuario($objUsuario);
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$lista = $objLogSistemaControl->listarPorUsuario();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objLogSistema){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString()."</font></br>";
		}

	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objLogSistema = new LogSistema(null);
		$objLogSistemaControl = new LogSistemaControl($objLogSistema);
		$lista = $objLogSistemaControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objLogSistema){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLogSistema->__toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
