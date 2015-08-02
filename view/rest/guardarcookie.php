<?php
setcookie("tema", $_POST['tema'], time() + (86400 * 30), "/"); // 86400 = 1 day

if(isset($_COOKIE['tema'])){
	echo $_COOKIE['tema'];
}else{
	echo 'nao tem cookie';
}