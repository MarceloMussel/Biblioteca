<?php
    require 'init.php';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : null;
    if (empty($titulo))
    {
        header('Location: msgErro.html');
    }
    $pesquisa = '%' . $titulo . '%';
    $PDO = db_connect();
    $sql = "SELECT L.id, L.titulo, L.autor, L.sessao_id, S.descricao FROM livro as L INNER JOIN sessao as S on L.sessao_id = S.id WHERE upper(titulo) like :titulo ORDER BY L.titulo ASC";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':titulo' => $pesquisa]);
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
                <p class="h3 text-center">Livros cadastrados encontrados na pesquisa</p>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Sessão</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($livro = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th scope="row"><?php echo $livro['id'] ?></th>
                        <td><?php echo $livro['titulo'] ?></td>
                        <td><?php echo $livro['autor'] ?></td>
                        <td><?php echo $livro['descricao'] ?></td>
                        <td>
                            <a class="btn btn-primary" href="formEditLivro.php?id=<?php echo $livro['id'] ?>">Editar</a>
                            <a class="btn btn-danger" href="deleteLivro.php?id=<?php echo $livro['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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