<?php

/*-- Testa se o tamanho da imagem atende o permitido --*/
list($width, $height, $type, $attr) = getimagesize('ad_squad.jpg');

if($width < 200 || $height < 100)
{
	echo "<font color='RED'> A Imagem é Muito Pequena!</br>
	<font color='Black'>Carregue uma imagem com tamanho superior a 200x100 altura/largura";
	exit;
}

// Chama o arquivo com a classe WideImage
require('WideImage.php');
// Carrega a imagem a ser manipulada
$image = WideImage::load('ad_squad.jpg');
// Redimensiona a imagem
$image = $image->resize(200, 100);
// Salva a imagem em um arquivo (novo ou não)
$image->saveToFile('nova_foto.png');

Echo "A Imagem foi reduzida!";

?>