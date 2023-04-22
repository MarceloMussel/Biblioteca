<?php
    require_once 'init.php';
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $localizacao = isset($_POST['localizacao']) ? $_POST['localizacao'] : null;

    if (empty($id) || empty($descricao) || empty($localizacao))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "UPDATE sessao SET descricao = :descricao, localizacao = :localizacao WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':localizacao', $localizacao);
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