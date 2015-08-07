<?php 
session_start();
if (isset($_COOKIE['tema'])){	
	switch ($_COOKIE['tema']) {
	
		case 'Classico':
			$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/css/ext-all.css">';
			break;
	
		case 'Neptune':
			$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-neptune/ext-theme-neptune-all.css">';
			break;
	
		case 'Gray':
			$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-gray/ext-theme-gray-all.css">';
			break;
			
		case 'Access':
			$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-access/ext-theme-access-all.css">';
			break;
		
	}
}else{
	$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-neptune/ext-theme-neptune-all.css">';
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Teste crmNuvio</title>
    <link rel="stylesheet" type="text/css" href="../libs/css/app.css">
    <?php echo $tema;?>	
	<script type="text/javascript" src="../libs/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../libs/ext/ext-all.js"></script>
    <script type="text/javascript" src="app.js"></script></head>
<body>

</body>
	<script src="../libs/ext/locale/ext-lang-pt_BR.js"></script>
</html>
