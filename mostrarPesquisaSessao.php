<?php
    require 'init.php';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    if (empty($descricao))
    {
        header('Location: msgErro.html');
    }
    $pesquisa = '%' . $descricao . '%';
    $PDO = db_connect();
    $sql = "SELECT id, descricao, localizacao FROM sessao WHERE upper(descricao) like :descricao";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':descricao' => $pesquisa]);
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
                <p class="h3 text-center">Sessões cadastradas encontradas na pesquisa</p>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Localização</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($sessao = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <th scope="row"><?php echo $sessao['id'] ?></th>
                        <td><?php echo $sessao['descricao'] ?></td>
                        <td><?php echo $sessao['localizacao'] ?></td>
                        <td>
                            <a class="btn btn-primary" href="formEditSessao.php?id=<?php echo $sessao['id'] ?>">Editar</a>
                            <a class="btn btn-danger" href="deleteSessao.php?id=<?php echo $sessao['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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