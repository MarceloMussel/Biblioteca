<?php
    require_once 'init.php';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }
    
    $PDO = db_connect();

    //verificar se o livro está emprestado
    $sqlEmprestimo = "SELECT COUNT(*) AS total FROM livroEmprestimo WHERE livro_id = :id";
    $stmtEmprestimo = $PDO->prepare($sqlEmprestimo);
    $stmtEmprestimo->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtEmprestimo->execute();
    $total = $stmtEmprestimo->fetchColumn();

    if($total > 0){
        header('Location: msgErro.html');
    }else{
        $sql = "DELETE FROM livro WHERE id = :id";
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