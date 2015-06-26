<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresausuario/EmpresaUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaUsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/empresa/Empresa.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/EmpresaControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';



/*-- Lista de Perfil --*/
// '- Lista de Empresas -';
$objEmpresa = new Empresa();
$objEmpresaControl = new EmpresaControl($objEmpresa);
$listaEmpresa = $objEmpresaControl->listarTodos();
// var_dump($listaEmpresa);

// '- Lista de Usuarios -';
$objUsuario = new Usuario();
$objUsuarioControl = new UsuarioControl($objUsuario);
$listaUsuario = $objUsuarioControl->listarTodos();
// var_dump($listaUsuario);

// '- Lista de Empresas e Usuarios -';
/*-- Lista de Perfil Rotina --*/
$objEmpresaUsuario = new EmpresaUsuario();
$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
$listaEmpresaUsuario = $objEmpresaUsuarioControl->listarTodos();
// var_dump($listaEmpresaUsuario);

?>

<html>
<head></head>
<body>
	<h1>Cadastrando Empresa Usuario</h1>
	<form action="" method="post">
		Empresa:
		<select id='empresa' name='empresa'>
			<option value='0'>Selecione o empresa</option>
			<?php 
			foreach ($listaEmpresa as $empresa)
			{
				?>
				<option value='<?php echo $empresa->getId() ?>'><?php echo $empresa->getNomeFantasia() ?></option>
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
	
	<h1>Buscando Empresa Usuario por ID</h1>
	Empresa Usuario:
	<form action="" method="post">
		<select id='empresausuario' name='empresausuario'>
			<option value='0'>Selecione o empresa</option>
			<?php 
			foreach ($listaEmpresaUsuario as $empresausuario)
			{
				?>
				<option value='<?php echo $empresausuario->getId() ?>'>ID: <?php echo $empresausuario->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando Empresa Usuario</h1>
	Empresa Usuario:
	<form action="" method="post">
		<select id='empresausuario' name='empresausuario'>
			<option value='0'>Selecione o empresa rotina</option>
			<?php 
			foreach ($listaEmpresaUsuario as $empresausuario)
			{
				?>
				<option value='<?php echo $empresausuario->getId() ?>'>ID: <?php echo $empresausuario->getId() ?></option>
				<?php
			}
			?>
		</select>
		Empresa:
		<select id='empresa' name='empresa'>
			<option value='0'>Selecione a empresa</option>
			<?php 
			foreach ($listaEmpresa as $empresa)
			{
				?>
				<option value='<?php echo $empresa->getId() ?>'><?php echo $empresa->getNomeFantasia() ?></option>
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
	
	<h1>Deletando Empresa Usuario</h1>
	<form action="" method="post">
		<select id='empresausuario' name='empresausuario'>
			<option value='0'>Selecione o Empresa Usuario</option>
			<?php 
			foreach ($listaEmpresaUsuario as $empresausuario)
			{
				?>
				<option value='<?php echo $empresausuario->getId() ?>'>ID: <?php echo $empresausuario->getId() ?></option>
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

// <?php
/*-- Cadastrar --*/
if(isset($_POST['cadastrar']))
{
	try{
		$objEmpresa = new Empresa($_POST['empresa']);
		$objUsuario = new Usuario($_POST['usuario']);
		$objEmpresaUsuario = new EmpresaUsuario();
		$objEmpresaUsuario->setObjEmpresa($objEmpresa);
		$objEmpresaUsuario->setObjUsuario($objUsuario);
		
		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$id = $objEmpresaUsuarioControl->cadastrar();

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
		$objEmpresaUsuario = new EmpresaUsuario($_POST['empresausuario']);
		$objEmpresaControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$objEmpresaUsuario = $objEmpresaControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objEmpresaUsuario->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		
		$objEmpresa = new Empresa($_POST['empresa']);
		$objUsuario = new Usuario($_POST['usuario']);
		$objEmpresaUsuario = new EmpresaUsuario();
		$objEmpresaUsuario->setObjEmpresa($objEmpresa);
		$objEmpresaUsuario->setObjUsuario($objUsuario);
		
		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$id = $objEmpresaUsuarioControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: Alterado com SUCESSO! </font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objEmpresaUsuario = new EmpresaUsuario($_POST['empresausuario']);
		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$objEmpresaUsuario = $objEmpresaUsuarioControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objEmpresaUsuario->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objEmpresaUsuario = new EmpresaUsuario();
		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$lista = $objEmpresaUsuarioControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objEmpresaUsuario){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objEmpresaUsuario->toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
