<?php
    require_once 'init.php';
    $idEmprestimo = isset($_GET['id']) ? $_GET['id'] : null;
    if (empty($idEmprestimo))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "SELECT LE.livro_id, LE.emprestimo_id, L.titulo from livroEmprestimo as LE INNER JOIN livro as L ON LE.livro_id = L.id WHERE LE.emprestimo_id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $idEmprestimo, PDO::PARAM_INT);
    $stmt->execute();   
    
    $sqlUsuario = "SELECT U.nome from livroEmprestimo as LE INNER JOIN emprestimo as E ON LE.emprestimo_id = E.id INNER JOIN usuario as U ON E.usuario_id = U.id WHERE LE.emprestimo_id = :id";
    $stmtUsuario = $PDO->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':id', $idEmprestimo, PDO::PARAM_INT);
    $stmtUsuario->execute();
    $usuario = $stmtUsuario->fetchColumn();
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
                <p class="h3 text-center">Livros emprestados para <?php echo $usuario ?></p>
            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Título</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($emprestimo = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $emprestimo['titulo'] ?></td>
                        <td>
                            <a class="btn btn-danger" href="deleteLivroEmprestimo.php?livro_id=<?php echo $emprestimo['livro_id'] ?>&emprestimo_id=<?php echo $idEmprestimo ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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