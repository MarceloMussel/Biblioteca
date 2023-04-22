<?php
    require 'init.php';
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "SELECT id, dataEmprestimo, usuario_id, dataDevolucao FROM emprestimo WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $emprestimo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!is_array($emprestimo))
    {
        header('Location: msgErro.html');
    }
    $sqlUsuario = "SELECT id, nome FROM usuario ORDER BY nome ASC";
    $stmtUsuario = $PDO->prepare($sqlUsuario);
    $stmtUsuario->execute();
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
            <p class="h3 text-center">Editar empréstimo de livros </p>
        </div>
        <form action="editEmprestimo.php" method="post">
            <div class="form-group">
                <label for="dataEmprestimo">Data do empréstimo: </label>
                <input type="date" class="form-control" name="dataEmprestimo" id="dataEmprestimo" required value="<?php echo $emprestimo['dataEmprestimo'] ?>">
            </div>
            <div class="form-group">
                <label for="usuario">Selecione o usuário</label>
                <select class="form-control" name="usuario" id="usuario" required>

                  <?php while($dados = $stmtUsuario->fetch(PDO::FETCH_ASSOC)): ?>

                    <?php if($dados['id'] == $emprestimo['usuario_id']): ?>

                        <option selected="selected" value=" <?php echo $dados['id'] ?> "> <?php echo $dados['nome'] ?> </option>
                    
                    <?php else: ?>

                        <option value=" <?php echo $dados['id'] ?> "> <?php echo $dados['nome'] ?> </option>

                    <?php endif; ?>
                      
                  <?php endwhile; ?>

                </select>
            </div>
            <div class="form-group">
                <label for="dataEmprestimo">Data da devolução: </label>
                <input type="date" class="form-control" name="dataDevolucao" id="dataDevolucao" value="<?php echo $emprestimo['dataDevolucao'] ?>">
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