<?php
    require_once 'init.php';
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $dataEmprestimo = isset($_POST['dataEmprestimo']) ? $_POST['dataEmprestimo'] : null;
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $dataDevolucao = isset($_POST['dataDevolucao']) ? $_POST['dataDevolucao'] : null;

    if (empty($id) || empty($dataEmprestimo) || empty($usuario))
    {
        header('Location: msgErro.html');
    }

    if(empty($dataDevolucao))
        $dataDevolucao = null;

    $PDO = db_connect();
    $sql = "UPDATE emprestimo SET dataEmprestimo = :dataEmprestimo, usuario_id = :usuario, dataDevolucao = :dataDevolucao WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':dataEmprestimo', $dataEmprestimo);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':dataDevolucao', $dataDevolucao);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute())
    {
        header('Location: msgSucesso.html');
    }
    else
    {
        header('Location: msgErro.html');
    }
    
?>