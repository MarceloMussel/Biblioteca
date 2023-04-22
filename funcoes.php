<?php

// Conecta com o MySQL usando PDO

function db_connect()
{
    $PDO = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

    return $PDO;
}

 //Converte datas entre os padrões ISO e brasileiro

function dateConvert($date)
{
    if(is_null($date))
        return $date;
    if ( ! strstr( $date, '/' ) )
    {
        // $date está no formato ISO (yyyy-mm-dd) e deve ser convertida
        // para dd/mm/yyyy
        $dataCorrigida = implode('/', array_reverse(explode('-', $date)));
    }
    else
    {
        // $date está no formato brasileiro e deve ser convertida para ISO
        $dataCorrigida = implode('-', array_reverse(explode('/', $date)));
    }

    return $dataCorrigida;
}
?>
