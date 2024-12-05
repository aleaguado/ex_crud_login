<?php
    session_start();
    require_once 'db_conn.php';
    include('msg.php');
    IF ($_SESSION['login'] != "YES") {
        header("Location: login.php");
    }
    IF ($_SERVER["REQUEST_METHOD"] === "POST") {
        session_destroy();
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Vamos usar o BootStrap para pegar alguns estilos prontos? -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Página Inicial</title>
</head>
<body>
<div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes da pessoa
                            <a href="create.php" class="btn btn-primary float-end">Adicionar gente</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Prontuário</th>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM gente";
                                    $query_run = mysqli_query($conn, $query);
                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $gente)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $gente['prontuario']; ?></td>
                                                <td><?= $gente['nome']; ?></td>
                                                <td>
                                                    <a href="update.php?prontuario=<?= $gente['prontuario']; ?> &nome= '<?= $gente['nome']; ?>'" class="btn btn-success btn-sm">Editar</a>
                                                    <a href="delete.php?prontuario=<?= $gente['prontuario']; ?> &nome= '<?= $gente['nome']; ?>'" class="btn btn-success btn-sm">Deletar</a>   
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Nenhuma gente cadastrada </h5>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST">
            <div class="mb-3 text-center" >
                <button type="submit" name="sair" class="btn btn-danger">Encerrar sessão</button>
            </div>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>