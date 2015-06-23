<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilRotinaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilrotina/PerfilRotinaDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfil/Perfil.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/rotina/Rotina.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/RotinaControl.php';

/*-- Lista de Perfil --*/
$objPerfil = new Perfil(null);
$objPerfilControl = new PerfilControl($objPerfil);
$listaPerfil = $objPerfilControl->listarTodos();

/*-- Lista de Rotina --*/
$objRotina = new Rotina(null);
$objRotinaControl = new RotinaControl($objRotina);
$listaRotina = $objRotinaControl->listarTodos();

/*-- Lista de Perfil Rotina --*/
$objPerfilRotina = new PerfilRotina(null);
$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
$listaPerfilRotina = $objPerfilRotinaControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando Perfil Rotina</h1>
	<form action="" method="post">
		Perfil:
		<select id='perfil' name='perfil'>
			<option value='0'>Selecione o perfil</option>
			<?php 
			foreach ($listaPerfil as $perfil)
			{
				?>
				<option value='<?php echo $perfil->getId() ?>'><?php echo $perfil->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		Rotina:
		<select id='rotina' name='rotina'>
			<option value='0'>Selecione a rotina</option>
			<?php 
			foreach ($listaRotina as $rotina)
			{
				?>
				<option value='<?php echo $rotina->getId() ?>'><?php echo $rotina->getNome() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando Perfil Rotina por ID</h1>
	Perfil Rotina:
	<form action="" method="post">
		<select id='perfilrotina' name='perfilrotina'>
			<option value='0'>Selecione o perfil</option>
			<?php 
			foreach ($listaPerfilRotina as $perfilRotina)
			{
				?>
				<option value='<?php echo $perfilRotina->getId() ?>'>ID: <?php echo $perfilRotina->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando Perfil Rotina</h1>
	Perfil Rotina:
	<form action="" method="post">
		<select id='perfilrotina' name='perfilrotina'>
			<option value='0'>Selecione o perfil rotina</option>
			<?php 
			foreach ($listaPerfilRotina as $perfilRotina)
			{
				?>
				<option value='<?php echo $perfilRotina->getId() ?>'>ID: <?php echo $perfilRotina->getId() ?></option>
				<?php
			}
			?>
		</select>
		Perfil:
		<select id='perfil' name='perfil'>
			<option value='0'>Selecione o perfil</option>
			<?php 
			foreach ($listaPerfil as $perfil)
			{
				?>
				<option value='<?php echo $perfil->getId() ?>'><?php echo $perfil->getNome() ?></option>
				<?php
			}
			?>
		
		</select>
		Rotina:
		<select id='rotina' name='rotina'>
			<option value='0'>Selecione a rotina</option>
			<?php 
			foreach ($listaRotina as $rotina)
			{
				?>
				<option value='<?php echo $rotina->getId() ?>'><?php echo $rotina->getNome() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando Perfil Rotina</h1>
	<form action="" method="post">
		<select id='perfilrotina' name='perfilrotina'>
			<option value='0'>Selecione o perfil</option>
			<?php 
			foreach ($listaPerfilRotina as $perfilRotina)
			{
				?>
				<option value='<?php echo $perfilRotina->getId() ?>'>ID: <?php echo $perfilRotina->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando Todos Perfil Rotina</h1>
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
		$objRotina = new Rotina($_POST['rotina']);
		$objPerfil = new Perfil($_POST['perfil']);
		$objPerfilRotina = new PerfilRotina();
		$objPerfilRotina->setObjPerfil($objPerfil);
		$objPerfilRotina->setObjRotina($objRotina);
		
		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
		$objPerfilRotina = $objPerfilRotinaControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilRotina->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objPerfilRotina = new PerfilRotina($_POST['perfilrotina']);
		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
		$objPerfilRotina = $objPerfilRotinaControl->buscarPorID();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilRotina->toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objRotina = new Rotina($_POST['rotina']);
		$objPerfil = new Perfil($_POST['perfil']);
		
		$objPerfilRotina = new PerfilRotina();
		$objPerfilRotina->setId($_POST['perfilrotina']);
		$objPerfilRotina->setObjPerfil($objPerfil);
		$objPerfilRotina->setObjRotina($objRotina);
		
		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
		$objPerfilRotina = $objPerfilRotinaControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilRotina->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objPerfilRotina = new PerfilRotina($_POST['perfilrotina']);
		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
		$objPerfilRotina = $objPerfilRotinaControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilRotina->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objPerfilRotina = new PerfilRotina(null);
		$objPerfilRotinaControl = new PerfilRotinaControl($objPerfilRotina);
		$lista = $objPerfilRotinaControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objPerfilRotina){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilRotina->toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
