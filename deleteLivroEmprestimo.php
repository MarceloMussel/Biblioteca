<?php
    require_once 'init.php';
    $livro_id = isset($_GET['livro_id']) ? $_GET['livro_id'] : null;
    $emprestimo_id = isset($_GET['emprestimo_id']) ? $_GET['emprestimo_id'] : null;
    if (empty($livro_id) || empty($emprestimo_id))
    {
        header('Location: msgErro.html');
    }
    
    $PDO = db_connect();

    $sqlLivro = "DELETE FROM livroEmprestimo WHERE livro_id = :livro_id AND emprestimo_id = :emprestimo_id";
    $stmtLivro = $PDO->prepare($sqlLivro);
    $stmtLivro->bindParam(':livro_id', $livro_id, PDO::PARAM_INT);
    $stmtLivro->bindParam(':emprestimo_id', $emprestimo_id, PDO::PARAM_INT);
    if ($stmtLivro->execute())
        header('Location: msgSucessoEmprestimo.html');
    else
        header('Location: msgErro.html');
?>