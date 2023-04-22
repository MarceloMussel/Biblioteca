<?php
    require_once 'init.php';
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (empty($id))
    {
        header('Location: msgErro.html');
    }
    $PDO = db_connect();

    //verificar se existe algum empréstimo para este usuário
    $sqlUsuario = "SELECT COUNT(*) AS total FROM emprestimo WHERE usuario_id = :id";
    $stmtUsuario = $PDO->prepare($sqlUsuario);
    $stmtUsuario->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtUsuario->execute();
    $total = $stmtUsuario->fetchColumn();

    if($total > 0){
        header('Location: msgErro.html');
    }else{
        $sql = "DELETE FROM usuario WHERE id = :id";
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