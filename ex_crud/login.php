<?php
session_start(); // Inicia os trabalhos com sessão
require_once 'db_conn.php'; // Inclui a conexão com o banco
include('msg.php'); // Inclui o arquivo que mostra mensagens
if ($_SERVER["REQUEST_METHOD"] === "POST") { //verifica se será chamado via método post
    $prontuario = $_POST["prontuario"]; //pega a variável prontuario q vem via POST
    $senha = $_POST["senha"]; //pega a variavel nome que vem via POST
    $sql = "select * from gente where prontuario = '$prontuario' and lower(prontuario) = '$senha'"; //Cria o insert!
    $query_run = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query_run) > 0) {
        $_SESSION['message'] = "Bem Vindo(a) $prontuario!"; //Cria a mensagem!
        $_SESSION['login'] = "YES";
        header("Location: index.php");
    } else {
        $_SESSION['message'] = "Senha incorreta"; //Cria a mensagem!
        header("Location: login.php"); //Chama o index!
    }
    $conn->close(); //Fecha a conexão com o banco
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Vamos usar o BootStrap para pegar alguns estilos prontos? -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login!</title>
</head>
<body>
<!-- Essas classes do CSS são todas do bootstrap!-->
<div class="container mt-5">
        <!-- O bootstrap organiza o layout em linhas (row) e colunas (col)-->
                <div class="card">
                    <div class="card-header">
                        <h4>Faça o login:</h4>
                    </div>
                    <div class="card-body">
                        <!-- Vamos omitir o  action porque queremos que o formulário chame ele mesmo!-->
                        <form method="POST">
                            <div class="mb-3">
                                <label>Prontuario</label>
                                <input type="text" name="prontuario" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="logar" class="btn btn-primary">Logar</button>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>