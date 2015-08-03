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
	$tema = '<link rel="stylesheet" type="text/css" href="../libs/ext/resources/css/ext-all.css">';
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Teste crmNuvio</title>
    <?php echo $tema;?>
<!-- 	<link rel="stylesheet" type="text/css" href="../libs/ext/resources/css/ext-all.css"> -->
<!--     <link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-gray/ext-theme-gray-all.css"> -->
<!--     <link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-access/ext-theme-access-all.css"> -->
<!-- 	<link rel="stylesheet" type="text/css" href="../libs/ext/resources/ext-theme-neptune/ext-theme-neptune-all.css"> -->
	<link rel="stylesheet" type="text/css" href="../libs/css/app.css">
<!-- 	<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/bootstrap.css"> -->
	<script type="text/javascript" src="../libs/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../libs/ext/ext-all-dev.js"></script>
    <script type="text/javascript" src="app.js"></script></head>
<body></body>
</html>
