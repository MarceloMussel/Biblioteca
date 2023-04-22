<?php
    require_once 'init.php';
    $dataEmprestimo = isset($_POST['dataEmprestimo']) ? $_POST['dataEmprestimo'] : null;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;

    if (empty($dataEmprestimo) || empty($usuario))
    {
        header('Location: msgErro.html');
    }

    $PDO = db_connect();
    $sql = "INSERT INTO emprestimo(dataEmprestimo, usuario_id) VALUES(:dataEmprestimo, :usuario)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':dataEmprestimo', $dataEmprestimo);
    $stmt->bindParam(':usuario', $usuario);

    if ($stmt->execute())
    {
        header('Location: msgSucessoEmprestimo.html');
    }
    else
    {
        header('Location: msgErro.html');
    }
?>