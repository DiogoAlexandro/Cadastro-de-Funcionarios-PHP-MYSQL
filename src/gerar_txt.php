<!--**
 *  Pagina que  gera  arquivo txt com  os contatos de todos do  banco;
 *-->
<?php
	session_start();
	include_once('config.php');
		$arquivo  = "contatos.txt";
		// Definimos o nome do arquivo que será exportado
		//Selecionar todos os itens da tabela 
		$result_msg_contatos = "SELECT * FROM funcionarios";
		$resultado_msg_contatos = mysqli_query($db , $result_msg_contatos);
		$conteudo="";
		while($row = mysqli_fetch_assoc($resultado_msg_contatos)) {
    $conteudo=$conteudo.chr(10)."0".preg_replace("/[^0-9]/", "", $row['telefone']).";"."0".preg_replace("/[^0-9]/", "", $row['celular']).";";
}
		file_put_contents($arquivo, $conteudo); 
		$arq = fopen($arquivo,"w");
		fwrite($arq,$conteudo);
		fclose($arq);
		// Configurações header para forçar o download
		header('Content-type: octet/stream');
		header('Content-disposition: attachment; filename="'.$arquivo.'";'); 
		readfile($arquivo);
		// Envia o conteúdo do arquivo
?>