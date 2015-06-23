<?php
/**
 * 
 * @author Fabiano Costa
 * 
 *
 */
class Utils
{
	static public function carregaClasses($filtro){
		//Diret�rio do projeto
		$dir_projeto = $_SERVER ['DOCUMENT_ROOT'] . "crmNuvio/";
		$dir_to_load = array("control","util");

		foreach($dir_to_load as $class_dir){
			//Listagem de diret�rios;
			$class_dir = $dir_projeto.$class_dir."/";
			$lista = opendir ($class_dir);
			while ($arquivos = readdir ($lista)) {
				$arquivo_para_incluir = $class_dir.$arquivos;
				if(is_file($arquivo_para_incluir)){
// 					echo $arquivos."<br>";
					require_once($arquivo_para_incluir);
				}
			}
			closedir($lista);
		}		

	}	
}
spl_autoload_register("Utils::carregaClasses");