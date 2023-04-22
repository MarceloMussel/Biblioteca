<?php
    require_once 'init.php';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;

    if (empty($nome) || empty($email) || empty($endereco) || empty($telefone))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();
    $sql = "INSERT INTO usuario(nome, email, endereco, telefone) VALUES(:nome, :email, :endereco, :telefone)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':telefone', $telefone);

    if ($stmt->execute())
    {
        header('Location: msgSucesso.html');
    }
    else
    {
        header('Location: msgErro.html');
    }
?>