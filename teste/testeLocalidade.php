<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/Localidade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/LocalidadeControl.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/localidade/LocalidadeDao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'model/pais/Pais.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/crmNuvio/" . 'control/PaisControl.php';



/*-- Lista de Pais --*/
$objPais = new Pais(null);
$objPaisControl = new PaisControl($objPais);
$listaPais = $objPaisControl->listarTodos();

/*-- Lista de localidade --*/
$objLocalidade = new Localidade(null);
$objLocalidadeControl = new LocalidadeControl($objLocalidade);
$listaLocalidade = $objLocalidadeControl->listarTodos();
?>

<html>
<head></head>
<body>
	<h1>Cadastrando Localidade</h1>
	<form action="" method="post">
		CodigoIBGE: <input type="text" name="codigoibge">
		UF: <input type="text" name="uf">
		Cidade: <input type="text" name="cidade">
		Pais:
		<select id='pais' name='pais'>
			<option value='0'>Selecione o Pais</option>
			<?php 
			foreach ($listaPais as $pais)
			{
				?>
				<option value='<?php echo $pais->getId() ?>'><?php echo $pais->getDescricao() ?></option>
				<?php
			}
			?>
		
		</select>
		
		<input type="submit" id="cadastrar" name="cadastrar" value="cadastrar">
	</form>
	
	<h1>Buscando Localidade por ID</h1>
	Pais:
	<form action="" method="post">
		<select id='localidade' name='localidade'>
			<option value='0'>Selecione o Pais</option>
			<?php 
			foreach ($listaLocalidade as $localidade)
			{
				?>
				<option value='<?php echo $localidade->getId() ?>'>ID: <?php echo $localidade->getId() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="buscar" name="buscar" value="buscar">
	</form>
	
	<h1>Alterando Localidade</h1>
	Localidade:
	<form action="" method="post">
		<select id='Localidade' name='Localidade'>
			<option value='0'>Selecione a Localidade</option>
			<?php 
			foreach ($listaLocalidade as $localidade)
			{
				?>
				<option value='<?php echo $localidade->getId() ?>'>Cod.IBGE: <?php echo $localidade->getCodigoIBGE() ?></option>
				<?php
			}
			?>
		</select>
		CodigoIBGE: <input type="text" name="codigoibge">
		UF: <input type="text" name="uf">
		Cidade: <input type="text" name="cidade">
		DataEdicao: <input type="text" name="dataedicao">
		Pais:
		<select id='pais' name='pais'>
			<option value='0'>Selecione o Pais</option>
			<?php 
			foreach ($listaPais as $pais)
			{
				?>
				<option value='<?php echo $pais->getId() ?>'><?php echo $pais->getDescricao() ?></option>
				<?php
			}
			?>
		
		</select>
		
		<input type="submit" id="alterar" name="alterar" value="alterar">
	</form>
	
	<h1>Deletando Localidade</h1>
	<form action="" method="post">
		<select id='localidade' name='localidade'>
			<option value='0'>Selecione a Localidade</option>
			<?php 
			foreach ($listaLocalidade as $localidade)
			{
				?>
				<option value='<?php echo $localidade->getId() ?>'>ID: <?php echo $localidade->getCodigoIBGE() ?></option>
				<?php
			}
			?>
		</select>
		<input type="submit" id="deletar" name="deletar" value="deletar">
	</form>
	
	<h1>Listando Todas Localidades</h1>
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
		$objPais = new Pais($_POST['pais']);
		$objLocalidade = new Localidade();
		$objLocalidade->setCodigoIBGE($_POST['codigoibge']);
		$objLocalidade->setUf($_POST['uf']);
		$objLocalidade->setCidade($_POST['cidade']);
		$objLocalidade->setObjPais($objPais);
		
		$objLocalidadeControl = new LocalidadeControl($objLocalidade);
		$objLocalidade = $objLocalidadeControl->cadastrar();

		echo "</br><font color='BLACK'> >>> CADASTRO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLocalidade->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- buscar --*/
if(isset($_POST['buscar']))
{
	try{
		$objLocalidade = new Localidade($_POST['localidade']);
		$objLocalidadeControl = new LocalidadeControl($objLocalidade);
		$objLocalidade = $objLocalidadeControl->buscarPorId();

		echo "</br><font color='BLACK'> >>> Busca <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLocalidade->__toString()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Alterar --*/
if(isset($_POST['alterar']))
{
	try{
		$objPais = new Pais($_POST['pais']);
		$objLocalidade = new Localidade();
		$objLocalidade->setId($_POST['Localidade']);
		$objLocalidade->setCodigoIBGE($_POST['codigoibge']);
		$objLocalidade->setUf($_POST['uf']);
		$objLocalidade->setCidade($_POST['cidade']);
		$objLocalidade->setDataedicao($_POST['dataedicao']);
		$objLocalidade->setObjPais($objPais);
		
		$objLocalidadeControl = new LocalidadeControl($objLocalidade);
		$objLocalidade = $objLocalidadeControl->atualizar();

		echo "</br><font color='BLACK'> >>> ALTUALIZANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLocalidade->__toString() ."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Deletar --*/
if(isset($_POST['deletar']))
{
	try{
		$objLocalidade = new Localidade($_POST['localidade']);
		$objLocalidadeControl = new LocalidadeControl($objLocalidade);
		$objLocalidade = $objLocalidadeControl->deletar();
	
		echo "</br><font color='BLACK'> >>> DELETANDO <<< </font></br>";
		echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLocalidade->getId()."</font>";
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}

/*-- Listar --*/
if(isset($_POST['listar']))
{
	try{
		$objLocalidade = new Localidade(null);
		$objLocalidadeControl = new LocalidadeControl($objLocalidade);
		$lista = $objLocalidadeControl->listarTodos();
		echo "</br><font color='BLACK'> >>> LISTANDO <<< </font></br>";
		foreach ($lista as $objLocalidade){
			echo "<font color='BLUE'>[INFO]: SUCESSO! ". $objLocalidade->__toString()."</font></br>";
		}
		
	}catch(Exception $e){
		echo "<font color='RED'>[ERRO]:". $e->getMessage() ."</font></br>";
	}
}
?>
