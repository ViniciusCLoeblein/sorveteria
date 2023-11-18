<?php

function conectaBD()
{
    $servername = "localhost";
    $database = "sorveteria";
    $username = "root";
    $password = "";

    $conexao = mysqli_connect($servername, $username, $password, $database);

    if (!$conexao) {
        die("Conexão falhou!" . mysqli_connect_error());
    } else {
        echo "<script>console.log('Conexão ok');</script>";
    }
    return $conexao;
}

function logout()
{
    setcookie('usuario', '', time() - (86400 * 15), "/");
}
