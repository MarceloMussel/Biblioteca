<?php
    require 'init.php';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    if (empty($nome))
    {
        header('Location: msgErro.html');
    }
    $pesquisa = '%' . $nome . '%';
    $PDO = db_connect();
    $sql = "SELECT id, nome, email, endereco, telefone FROM usuario WHERE upper(nome) like :nome";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':nome' => $pesquisa]);
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
                <p class="h3 text-center">Usuários cadastrados encontrados na pesquisa</p>
        </div>
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Endereço</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <th scope="row"><?php echo $usuario['id'] ?></th>
                <td><?php echo $usuario['nome'] ?></td>
                <td><?php echo $usuario['email'] ?></td>
                <td><?php echo $usuario['endereco'] ?></td>
                <td><?php echo $usuario['telefone'] ?></td>
                <td>
                    <a class="btn btn-primary" href="formEditUsuario.php?id=<?php echo $usuario['id'] ?>">Editar</a>
                    <a class="btn btn-danger" href="deleteUsuario.php?id=<?php echo $usuario['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
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