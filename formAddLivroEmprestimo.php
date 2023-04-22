<?php
    require 'init.php';
    $idEmprestimo = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($idEmprestimo))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();

    $sqlLivros = "SELECT id, titulo FROM livro ORDER BY titulo ASC";
    $stmtLivros = $PDO->prepare($sqlLivros);
    $stmtLivros->execute();
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
            <p class="h3 text-center">Cadastro de empréstimo de livros</p>
        </div>
        <form action="addLivroEmprestimo.php" method="post">
            <div class="form-group">
                <label for="livro">Selecione o livro</label>
                <select class="form-control" name="livro" id="livro" required>

                  <?php while($dados = $stmtLivros->fetch(PDO::FETCH_ASSOC)): ?>

                        <option value=" <?php echo $dados['id'] ?> "> <?php echo $dados['titulo'] ?> </option>
                      
                  <?php endwhile; ?>

                </select>
            </div>
            <input type="hidden" name="idEmprestimo" value="<?php echo $idEmprestimo ?>">
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