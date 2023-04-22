<?php
    require_once 'init.php';

    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }

    $PDO = db_connect();
    $sql = "SELECT id, descricao, localizacao FROM sessao WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $sessao = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!is_array($sessao))
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
            <p class="h3 text-center">Editar sessão</p>
        </div>
        <form action="editSessao.php" method="post">
            <div class="form-group">
                <label for="descricao">Descrição: </label>
                <input type="text" class="form-control" name="descricao" id="descricao" required minlength="5" value="<?php echo $sessao['descricao'] ?>">
            </div>
            <div class="form-group">
                <label for="localizacao">Localização: </label>
                <input type="text" class="form-control" name="localizacao" id="localizacao" required minlength="5" value="<?php echo $sessao['localizacao'] ?>">
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