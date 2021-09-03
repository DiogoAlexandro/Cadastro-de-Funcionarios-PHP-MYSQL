<!--**
 *  creditos ao @author Cesaak - Celke -   cesar@celke.com.br
 *-->
 <?php
	session_start();
	include_once('config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Contato</title>
	<head>
	<body>
		<?php
		// Definimos o nome do arquivo que será exportado
		$arquivo = 'funcionarios.xls';
		
		// Criamos uma tabela HTML com o formato da planilha
		$html = '';
		$html .= '<table border="1">';
		$html .= '<tr>';
		$html .= '<td colspan="5">Planilha Mensagem de Contatos</tr>';
		$html .= '</tr>';
		
		
		$html .= '<tr>';
		$html .= '<td><b>ID</b></td>';
		$html .= '<td><b>Nome</b></td>';
		$html .= '<td><b>E-mail</b></td>';
		$html .= '<td><b>Telefone</b></td>';
		$html .= '<td><b>Celular</b></td>';
		$html .= '<td><b>Cidade</b></td>';
		$html .= '<td><b>Nascimento</b></td>';
		$html .= '<td><b>Salario</b></td>';
		$html .= '<td><b>Data</b></td>';
		$html .= '</tr>';
		
		//Selecionar todos os itens da tabela 
		$result_msg_contatos = "SELECT * FROM funcionarios";
		$resultado_msg_contatos = mysqli_query($db , $result_msg_contatos);
		
		while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
			$html .= '<tr>';
			$html .= '<td>'.$row_msg_contatos["id"].'</td>';
			$html .= '<td>'.$row_msg_contatos["nome"].'</td>';
			$html .= '<td>'.$row_msg_contatos["email"].'</td>';
			$html .= '<td>'."0".$row_msg_contatos["telefone"].";".$row_msg_contatos["celular"].";".'</td>';
			$html .= '<td>'.$row_msg_contatos["celular"].'</td>';
			$html .= '<td>'.$row_msg_contatos["cidade"].'</td>';
			$html .= '<td>'.$row_msg_contatos["nascimento"].'</td>';
			$html .= '<td>'.$row_msg_contatos["salario"].'</td>';
			$data = date('d/m/Y H:i:s',strtotime($row_msg_contatos["datacriacao"]));
			$html .= '<td>'.$data.'</td>';
			$html .= '</tr>';
			;
		}
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		echo $html;
		exit; ?>
	</body>
</html>