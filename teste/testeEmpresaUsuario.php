<?php
var_dump($_POST);
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
	Perfil Rotina:
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

// <?php
/*-- Cadastrar --*/
if(isset($_POST['cadastrar']))
{
	try{
		$objEmpresa = new Empresa($_POST['empresa']);
		$objUsuario = new Usuario($_POST['usuario']);
		$objEmpresaUsuario = new EmpresaUsuario();
		$objEmpresaUsuario->setOdjEmpresa($objEmpresa);
		$objEmpresaUsuario->setObjUsuario($objUsuario);
		
		$objEmpresaUsuarioControl = new EmpresaUsuarioControl($objEmpresaUsuario);
		$objEmpresaUsuario = $objEmpresaUsuarioControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ID: ". $objEmpresaUsuario ."</font>";
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
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objEmpresaUsuario->jsonSerialize() ."</font>";
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
