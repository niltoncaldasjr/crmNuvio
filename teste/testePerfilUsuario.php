<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/perfilusuario/PerfilUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PerfilUsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';


// '- Lista de Perfil -';
$objPerfil = new Perfil();
$objPerfilControl = new PerfilControl($objPerfil);
$listaPerfil = $objPerfilControl->listarTodos();
// var_dump($listaPerfil);

// '- Lista de Usuarios -';
$objUsuario = new Usuario();
$objUsuarioControl = new UsuarioControl($objUsuario);
$listaUsuario = $objUsuarioControl->listarTodos();
// var_dump($listaUsuario);

// '- Lista de Empresas e Usuarios -';
$objPerfilUsuario = new PerfilUsuario();
$objPerfilUsuarioControl = new PerfilUsuarioControl($objPerfilUsuario);
$listaPerfilUsuario = $objPerfilUsuarioControl->listarTodos();
// var_dump($listaEmpresaUsuario);

?>

<html>
<head></head>
<body>
	<h1>Cadastrando Perfil Usuario</h1>
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
		Usuario:
		<select id='usuario' name='usuario'>
			<option value='0'>Selecione a usuario</option>
			<?php 
			foreach ($listaUsuario as $usuario)
			{
				?>
				<option value='<?php echo $usuario->getId() ?>'><?php echo $usuario->getNome() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando Perfil Usuario por ID</h1>
	Perfil Usuario:
	<form action="" method="post">
		<select id='perfilusuario' name='perfilusuario'>
			<option value='0'>Selecione o perfilusuario</option>
			<?php 
			foreach ($listaPerfilUsuario as $perfilusuario)
			{
				?>
				<option value='<?php echo $perfilusuario->getId() ?>'>ID: <?php echo $perfilusuario->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando Perfil Usuario</h1>
	Perfil Usuario:
	<form action="" method="post">
		<select id='perfilusuario' name='perfilusuario'>
			<option value='0'>Selecione o perfil usuario</option>
			<?php 
			foreach ($listaPerfilUsuario as $perfilusuario)
			{
				?>
				<option value='<?php echo $perfilusuario->getId() ?>'>ID: <?php echo $perfilusuario->getId() ?></option>
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
		Usuario:
		<select id='usuario' name='usuario'>
			<option value='0'>Selecione a rotina</option>
			<?php 
			foreach ($listaUsuario as $usuario)
			{
				?>
				<option value='<?php echo $usuario->getId() ?>'><?php echo $usuario->getNome() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando Perfil Usuario</h1>
	<form action="" method="post">
		<select id='perfilusuario' name='perfilusuario'>
			<option value='0'>Selecione o Perfil Usuario</option>
			<?php 
			foreach ($listaPerfilUsuario as $perfilusuario)
			{
				?>
				<option value='<?php echo $perfilusuario->getId() ?>'>ID: <?php echo $perfilusuario->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando Todos Perfil Usuario</h1>
	<form action="" method="post">
	Listar todos:
	<input type="submit" id="listar" name="listar" value="listar">
	</form>

	______________________________________________________________________________________________________________________
</body>
</html>

// <?php
/*-- Cadastrar --*/
if(isset($_POST['cadastrar']))
{
	try{
		$objPefil = new Perfil($_POST['perfil']);
		$objUsuario = new Usuario($_POST['usuario']);
		$objPerfilUsuario = new PerfilUsuario();
		$objPerfilUsuario->setObjPerfil($objPefil);
		$objPerfilUsuario->setObjUsuario($objUsuario);
		
		$objPerfilUsuarioControl = new PerfilUsuarioControl($objPerfilUsuario);
		$id = $objPerfilUsuarioControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ID: ". $id ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objPerfilUsuario = new PerfilUsuario($_POST['perfilusuario']);
		$objPerfilUsuarioControl = new PerfilUsuarioControl($objPerfilUsuario);
		$objPerfilUsuario = $objPerfilUsuarioControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilUsuario->toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objPerfil = new Perfil($_POST['perfil']);
		$objUsuario = new Usuario($_POST['usuario']);
		
		$objPerfilUsuario = new PerfilUsuario();
		$objPerfilUsuario->setId($_POST['perfilusuario']);
		$objPerfilUsuario->setObjPerfil($objPerfil);
		$objPerfilUsuario->setObjUsuario($objUsuario);
		
		$objPerfilUsuarioControl = new PerfilUsuarioControl($objPerfilUsuario);
		$objPerfilUsuario = $objPerfilUsuarioControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilUsuario->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objPerfilUsuario = new PerfilUsuario($_POST['perfilusuario']);
		$objPerfilUsuarioControl = new PerfilUsuarioControl($objPerfilUsuario);
		$objPerfilUsuario = $objPerfilUsuarioControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilUsuario->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objPerfilUsuario = new PerfilUsuario();
		$objPerfilUsuarioControl = new PerfilUsuarioControl();
		$lista = $objPerfilUsuarioControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objPerfilUsuario){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objPerfilUsuario->toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
