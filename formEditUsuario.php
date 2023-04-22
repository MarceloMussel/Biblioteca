<?php
    require_once 'init.php';

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }

    $PDO = db_connect();
    $sql = "SELECT id, nome, email, endereco, telefone FROM usuario WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!is_array($usuario))
    {
        header('Location: msgErro.html');
    }
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
    <script src="bootstrap/js/jqueryMask.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(function(){
                $("#menu").load("navbar.html");
                $('#telefone').mask('(99)99999-9999');
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
            <p class="h3 text-center">Editar usuário</p>
        </div>
        <form action="editUsuario.php" method="post">
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control" name="nome" id="nome" required minlength="5" value="<?php echo $usuario['nome'] ?>">
            </div>
            <div class="form-group">
                <label for="email">email: </label>
                <input type="email" class="form-control" name="email" id="email" required value="<?php echo $usuario['email'] ?>">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço: </label>
                <input type="text" class="form-control" name="endereco" id="endereco" required minlength="5" value="<?php echo $usuario['endereco'] ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone: </label>
                <input type="text" class="form-control" name="telefone" id="telefone" required minlength="5" value="<?php echo $usuario['telefone'] ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <button type="submit" class="btn btn-primary" id="submit" value="Submit">Enviar</button>
            <a class="btn btn-danger" href="index.html">Cancelar</a>
            
          </form>
    </div>
    <div class="container">
        <div class="card-footer">
            <p class="h6 text-center">Todos os direitos reservados a &copy;Copyright</p>
        </div>
    </div>
</body>
</html>