<?php
include('session.php');
//Diogo Alexandro Silva Oliveira - Cadastro de funcionarios

// IF que envia os dados pelo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $telefone = (isset($_POST["telefone"]) && $_POST["telefone"] != null) ? $_POST["telefone"] : "";
	$celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : "";
	$email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
	$cidade = (isset($_POST["cidade"]) && $_POST["cidade"] != null) ? $_POST["cidade"] : "";
	$nascimento = (isset($_POST["nascimento"]) && $_POST["nascimento"] != null) ? $_POST["nascimento"] : "";
	$salario = (isset($_POST["salario"]) && $_POST["salario"] != null) ? $_POST["salario"] : "";
    $datacriacao = (isset($_POST["datacriacao"]) && $_POST["datacriacao"] != null) ? $_POST["datacriacao"] : "";
    $datamodificacao = (isset($_POST["datamodificacao"]) && $_POST["datamodificacao"] != null) ? $_POST["datamodificacao"] : "";


} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
	$telefone = NULL;
	$celular = NULL;
	$email = NULL;
	$cidade = NULL;
	$nascimento = NULL;
	$salario = NULL;
    $datacriacao = NULL;
    $datamodificacao = NULL;

}
 
// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=empresa", "teste", "teste102030");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}
 
// If de insert e update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE funcionarios SET nome=?, telefone=?, celular=?, email=?, cidade=?, nascimento=?, salario=? WHERE id = ?");
            $stmt->bindParam(8, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO funcionarios (nome, telefone, celular, email, cidade, nascimento, salario) VALUES (?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $telefone);
        $stmt->bindParam(3, $celular);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $cidade);
		$stmt->bindParam(6, $nascimento);
        $stmt->bindParam(7, $salario);




        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Dados cadastrados com sucesso!";
                $id = null;
                $nome = null;
				$celular = null;
                $telefone = null;
                $email = null;
                $cidade = null;
                $nascimento = null;
                $salario = null;



            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// IF que volta os dados para o formulario para fazer alteração
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM funcionarios WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $celular = $rs->celular;
            $telefone = $rs->telefone;
			$email = $rs->email;
            $cidade = $rs->cidade;
            $nascimento = $rs->nascimento;
            $salario = $rs->salario;
            $datacriacao = $rs->datacriacao;
            $datamodificacao = $rs->datamodificacao;

        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
 
// If que faz o delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM funcionarios WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
<!DOCTYPE html>
    <html lang="pt-BR">

        <head>
            <meta charset="UTF-8">
            <title>Cadastro de funcionarios</title>
    </head>
    <body>
        <form action="?act=save" method="POST" name="form1" >
            <h1>Cadastro de funcionarios</h1>
            <hr>
            <input type="hidden" name="id" <?php
            // Preenche o id no campo id com um valor "value"
            if (isset($id) && $id != null || $id != "") {
                echo "value=\"{$id}\"";
            }
            ?> />
            Nome:
            <input type="text" name="nome" <?php
            // Preenche o nome no campo nome com um valor "value"
            if (isset($nome) && $nome != null || $nome != ""){
                echo "value=\"{$nome}\"";
            }
            ?> />
			Telefone:
            <input type="text" name="telefone" <?php
            // Preenche o telefone no campo telefone com um valor "value"
            if (isset($telefone) && $telefone != null || $telefone != ""){
                echo "value=\"{$telefone}\"";
            }
            ?> />
			Celular:
            <input type="text" name="celular" <?php
            // Preenche o celular no campo celular com um valor "value"
            if (isset($celular) && $celular != null || $celular != ""){
                echo "value=\"{$celular}\"";
            }
            ?> />
            E-mail:
            <input type="text" name="email" <?php
            // Preenche o email no campo email com um valor "value"
            if (isset($email) && $email != null || $email != ""){
                echo "value=\"{$email}\"";
            }
            ?> />
            Cidade:
            <input type="text" name="cidade" <?php
            // Preenche o cidade no campo cidade com um valor "value"
            if (isset($cidade) && $cidade != null || $cidade != ""){
                echo "value=\"{$cidade}\"";
            }
            ?> />
			Data de Nascimento:
            <input type="date" name="nascimento" <?php
            // Preenche a data no campo nascimento com um valor "value"
            if (isset($nascimento) && $nascimento != null || $nascimento != ""){
                echo "value=\"{$nascimento}\"";
            }
            ?> />
			Salario:
            <input type="text" name="salario" <?php
            // Preenche o salario no campo salario com um valor "value"
            if (isset($salario) && $salario != null || $salario != ""){
                echo "value=\"{$salario}\"";
            }5
            ?> />
            <input type="hidden" name="datacriacao" <?php
            // Preenche o datacriacao no campo datacriacao com um valor "value"
            if (isset ($datacriacao) && $datacriacao != null || $datacriacao != ""){
                echo "value=\"{$datacriacao}\"";
            }
            ?> />
            <input type="hidden" name="datacriacao" <?php
            // Preenche o datacriacao no campo datacriacao com um valor "value"
            if (isset ($datamodificacao) && $datamodificacao != null || $datamodificacao!= ""){
                echo "value=\"{$datamodificacao}\"";
            }
            ?> />
            



            <input type="submit" value="Salvar" />
           <input type="reset" value="Novo" />
			<a href="gerar_planilha.php"><button type='button' class='btn btn-sm btn-success'>Gerar Excel</button></a>
            <a href="gerar_txt.php"><button type='button' class='btn btn-sm btn-success'>Gerar Txt</button></a>
            <br/>
           Link para formulario: <input TYPE="button" VALUE="E-mail"
                   onclick="location.href='formulario.php'">
            <input TYPE="button" VALUE="Sair"
                                         onclick="location.href='logout.php'">
           <hr>
        </form>
		<table border="1" width="100%">
    <tr>
        <th>Nome</th>
        <th>Celular</th>
        <th>Telefone</th>
        <th>E-mail</th>
		<th>Cidade</th>
        <th>Data de Nascimento</th>
        <th>Salario</th>
        <th>Data Criação</th>
        <th>Data Modificação</th>

    </tr>
                <?php
 
                // IF que volta os dados na tela
                try {
                    $stmt = $conexao->prepare("SELECT * FROM funcionarios");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>".$rs->nome."</td><td>".$rs->celular."</td><td>".$rs->telefone."</td><td>".$rs->email."</td><td>"
									   .$rs->cidade."</td><td>".$rs->nascimento."</td><td>".$rs->salario."</td><td>".$rs->datacriacao
                                ."</td><td>".$rs->datamodificacao
                                ."</td><td><center><a href=\"?act=upd&id=".$rs->id."\">[Alterar]</a>"
                                       ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                       ."<a href=\"?act=del&id=".$rs->id."\">[Excluir]</a></center></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }
                ?>

            </table>
        </body>
    </html>