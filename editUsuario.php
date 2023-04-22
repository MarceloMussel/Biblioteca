<?php
    require_once 'init.php';
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;

    if (empty($id) || empty($nome) || empty($email) || empty($endereco) || empty($telefone))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "UPDATE usuario SET nome = :nome, email = :email, endereco = :endereco, telefone = :telefone WHERE id = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);
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