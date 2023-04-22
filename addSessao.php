<?php
    require_once 'init.php';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
    $localizacao = isset($_POST['localizacao']) ? $_POST['localizacao'] : null;

    if (empty($descricao) || empty($localizacao))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "INSERT INTO sessao(descricao, localizacao) VALUES(:descricao, :localizacao)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':localizacao', $localizacao);

    if ($stmt->execute())
    {
        header('Location: msgSucesso.html');
    }
    else
    {
        header('Location: msgErro.html');
    }
?>