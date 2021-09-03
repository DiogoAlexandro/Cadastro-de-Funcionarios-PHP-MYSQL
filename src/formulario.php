<?php
if (isset($_POST['Envia'])) {

    // POST com as variaveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];

    $email_remetente = "email@doseudominio"; // aqui a gente tem que colocar o email do nosso dominio para que funcione
    $email_destinatario = "email@querecebe"; // pode ser qualquer email que receberá as mensagens
    $email_reply = "$email";
    $email_assunto = "Contato formmail"; // Este será o assunto da mensagem

    $email_conteudo = "Nome = $nome \n";
    $email_conteudo .= "Email = $email \n";
    $email_conteudo .= "Telefone = $telefone \n";
    $email_conteudo .= "Mensagem = $mensagem \n";

    // Aqui é settado os headers
    $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );

    // IF para envio de email
    if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
        echo "</b>E-Mail enviado com sucesso!</b>";
    }
    else{
        echo "</b>Falha no envio do E-Mail!</b>"; }

}
?>

<form action="<? $PHP_SELF; ?>" method="POST">
    <p>
        Nome:<br />
        <input type="text" size="30" name="nome">
    </p>
    <p>
        E-mail:<br />
        <input type="text" size="30" name="email">
    </p>
    <p>
        Telefone:<br />
        <input type="text" size="35" name="telefone">
    </p>
    <p>
        Mensagem:<br />
        <input type="text" size="35" name="mensagem">
    </p>
    <p>
        <input type="submit" name="Envia" value="Enviar">
        <input type="reset" name="Apaga" value="Apagar">
        <input TYPE="button" VALUE="Sair"
               onclick="location.href='logout.php'">
    </p>