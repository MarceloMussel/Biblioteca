<?php
    require_once 'init.php';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }
    
    $PDO = db_connect();

    //verificar se existe algum livro para esta sessão
    $sqlLivro = "SELECT COUNT(*) AS total FROM livro WHERE sessao_id = :id";
    $stmtLivro = $PDO->prepare($sqlLivro);
    $stmtLivro->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtLivro->execute();
    $total = $stmtLivro->fetchColumn();

    if($total > 0){
        header('Location: msgErro.html');
    }else{
        $sql = "DELETE FROM sessao WHERE id = :id";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute())
        {
            header('Location: msgSucesso.html');
        }
        else
        {
            header('Location: msgErro.html');
        }
    }
?>