<?php
    require_once 'init.php';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }
    
    $PDO = db_connect();

    //deletar os registros na tabela livroEmprestimo

    $sqlLivro = "DELETE FROM livroEmprestimo WHERE emprestimo_id = :id";
    $stmtLivro = $PDO->prepare($sqlLivro);
    $stmtLivro->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmtLivro->execute())
    {
        // deletar o registro na tabela emprestimo

        $sql = "DELETE FROM emprestimo WHERE id = :id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if($stmt->execute())
            header('Location: msgSucesso.html');
        else
            header('Location: msgErro.html');
    }
    else
        header('Location: msgErro.html');
    
    
?>