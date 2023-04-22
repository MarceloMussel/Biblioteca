<?php
    require_once 'init.php';

    $usuario_id = isset($_GET['usuario_id']) ? (int) $_GET['usuario_id'] : null;
    if (empty($usuario_id))
    {
        header('Location: msgErro.html');
    }

    $PDO = db_connect();

    $sql = "SELECT E.id, E.dataEmprestimo, E.usuario_id, E.dataDevolucao, U.nome FROM emprestimo as E INNER JOIN usuario as U ON E.usuario_id = U.id WHERE E.usuario_id = :usuario_id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Biblioteca</title>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap/js/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(function(){
                    $("#menu").load("navbar.html");
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div id="menu"></div>
        </div>
        <div class="container">
            <div class="jumbotron">
                <p class="h3 text-center">Empréstimos cadastrados</p>
            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Data do empréstimo</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Data da devolução</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th scope="row"><?php echo $dados['id'] ?></th>
                        <td><?php echo dateConvert($dados['dataEmprestimo']) ?></td>
                        <td><?php echo $dados['nome'] ?></td>
                        <td><?php echo dateConvert($dados['dataDevolucao']) ?></td>
                        <td>
                            <a class="btn btn-primary" href="formAddLivroEmprestimo.php?id=<?php echo $dados['id'] ?>">Adicionar Livro</a>
                            <a class="btn btn-secondary" href="exibirLivrosEmprestimo.php?id=<?php echo $dados['id'] ?>">Ver Livros</a>
                            <a class="btn btn-info" href="formEditEmprestimo.php?id=<?php echo $dados['id'] ?>">Editar</a>
                            <a class="btn btn-danger" href="deleteEmprestimo.php?id=<?php echo $dados['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
        </div>
        <div class="container">
            <div class="card-footer">
                <p class="h6 text-center">Todos os direitos reservados a &copy;Copyright</p>
            </div>
        </div>
    </body>
</html>