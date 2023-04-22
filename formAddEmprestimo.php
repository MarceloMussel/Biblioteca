<?php
    require_once 'init.php';
    $PDO = db_connect();
    $sql = "SELECT id, nome FROM usuario ORDER BY nome ASC";
    $stmt = $PDO->prepare($sql);
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
            <p class="h3 text-center">Cadastro de empréstimo de livros</p>
        </div>
        <form action="addEmprestimo.php" method="post">
            <div class="form-group">
                <label for="dataEmprestimo">Data do empréstimo: </label>
                <input type="date" class="form-control" name="dataEmprestimo" id="dataEmprestimo" required placeholder="Informe a data do empréstimo">
            </div>
            <div class="form-group">
                <label for="usuario">Selecione o usuário</label>
                <select class="form-control" name="usuario" id="usuario" required>

                  <?php while($dados = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

                        <option value=" <?php echo $dados['id'] ?> "> <?php echo $dados['nome'] ?> </option>
                      
                  <?php endwhile; ?>

                </select>
            </div>
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