<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatolead/ContatoLead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/ContatoLeadControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/contatolead/ContatoLeadDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/usuario/Usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/UsuarioControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/lead/Lead.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LeadControl.php';

/*-- Lista de Usuario --*/
$objUsuario = new Usuario(null);
$objUsuarioControl = new UsuarioControl($objUsuario);
$listaUsuario = $objUsuarioControl->listarTodos();

/*-- Lista de Lead --*/
$objLead = new Lead(null);
$objLeadControl = new LeadControl($objLead);
$listaLead = $objLeadControl->listarTodos();

/*-- Lista de Contato Lead --*/
$objContatoLead = new ContatoLead(null);
$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
$listaContatoLead = $objContatoLeadControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando ContatoLead</h1>
	<form action="" method="post">
		DataContato: <input type="text" name="datacontato"/>
		Descricao : <input type="text" name="descricao"/>
		DataRetorno: <input type="text" name="dataretorno"/>
		DataCadastro: <input type="text" name="datacadastro"/>
		DataEdicao: <input type="text" name="dataedicao"/>
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
		Lead:
		<select id='Lead' name='Lead'>
			<option value='0'>Selecione a Lead</option>
			<?php 
			foreach ($listaLead as $Lead)
			{
				?>
				<option value='<?php echo $Lead->getId() ?>'><?php echo $Lead->getEmpresa() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando ContatoLead por ID</h1>
	Usuario Lead:
	<form action="" method="post">
		<select id='ContatoLead' name='ContatoLead'>
			<option value='0'>Selecione o Usuario</option>
			<?php 
			foreach ($listaContatoLead as $ContatoLead)
			{
				?>
				<option value='<?php echo $ContatoLead->getId() ?>'>Conta: <?php echo $ContatoLead->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando ContatoLead</h1>
	Usuario Lead:
	<form action="" method="post">
		<select id='ContatoLead' name='ContatoLead'>
			<option value='0'>Selecione o ContatoLead</option>
			<?php 
			foreach ($listaContatoLead as $ContatoLead)
			{
				?>
				<option value='<?php echo $ContatoLead->getId() ?>'>Conta: <?php echo $ContatoLead->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		DataContato: <input type="text" name="datacontato"/>
		Descricao : <input type="text" name="descricao"/>
		DataRetorno: <input type="text" name="dataretorno"/>
		DataEdicao: <input type="text" name="dataedicao"/>
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
		Lead:
		<select id='Lead' name='Lead'>
			<option value='0'>Selecione a Lead</option>
			<?php 
			foreach ($listaLead as $Lead)
			{
				?>
				<option value='<?php echo $Lead->getId() ?>'><?php echo $Lead->getNomeReduzido() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando ContatoLead</h1>
	<form action="" method="post">
		<select id='ContatoLead' name='ContatoLead'>
			<option value='0'>Selecione o Usuario</option>
			<?php 
			foreach ($listaContatoLead as $ContatoLead)
			{
				?>
				<option value='<?php echo $ContatoLead->getId() ?>'>Conta: <?php echo $ContatoLead->getNumeroConta() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando ContatoLead</h1>
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
		$objLead = new Lead($_POST['Lead']);
		$objUsuario = new Usuario($_POST['Usuario']);
		
		$objContatoLead = new ContatoLead();
		$objContatoLead->setDatacontato($_POST['datacontato']);
		$objContatoLead->setDescricao($_POST['descricao']);
		$objContatoLead->setDataretorno($_POST['dataretorno']);
		$objContatoLead->setDatacadastro($_POST['datacadastro']);
		$objContatoLead->setDataedicao($_POST['dataedicao']);
		$objContatoLead->setObjUsuario($objUsuario);
		$objContatoLead->setObjLead($objLead);
		
		$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
		$objContatoLead = $objContatoLeadControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContatoLead->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objContatoLead = new ContatoLead($_POST['ContatoLead']);
		$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
		$objContatoLead = $objContatoLeadControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContatoLead->toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objLead = new Lead($_POST['Lead']);
		$objUsuario = new Usuario($_POST['Usuario']);
		
		$objContatoLead = new ContatoLead($_POST['Lead']);
		$objContatoLead->setDatacontato($_POST['datacontato']);
		$objContatoLead->setDescricao($_POST['descricao']);
		$objContatoLead->setDataretorno($_POST['dataretorno']);
		$objContatoLead->setDataedicao($_POST['dataedicao']);
		$objContatoLead->setObjUsuario($objUsuario);
		$objContatoLead->setObjLead($objLead);
		$objContatoLead->setObjUsuario($objUsuario);
		$objContatoLead->setObjLead($objLead);
		
		
		$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
		$objContatoLead = $objContatoLeadControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContatoLead->toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objContatoLead = new ContatoLead($_POST['ContatoLead']);
		$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
		$objContatoLead = $objContatoLeadControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContatoLead->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objContatoLead = new ContatoLead(null);
		$objContatoLeadControl = new ContatoLeadControl($objContatoLead);
		$lista = $objContatoLeadControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objContatoLead){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objContatoLead->toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
