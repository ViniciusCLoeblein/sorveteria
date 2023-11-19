<?php
include_once("../../utils/index.php");

echo json_encode($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == "update") {
    $conn = conectaBD();
    $tableName = $_POST["tableName"];
    $query = '';

    switch ($tableName) {
        case 'usuario':
            $dataBrasileira = $_POST["Data_nascimento"];
            $dataAmericana = DateTime::createFromFormat('d/m/Y', $dataBrasileira)->format('Y-m-d');

            $query = "UPDATE usuario
                      SET nome = '{$_POST["nome"]}',
                          sobrenome = '{$_POST["sobrenome"]}',
                          CPF = '{$_POST["CPF"]}',
                          dtaNascimento = '{$dataAmericana}',
                          indAdm = '{$_POST["Administrador"]}'
                      WHERE codUsuario = '{$_POST["id"]}'
                      ";
            break;
        case 'categoria':
            $columnName = 'codCategoria';
            break;
        case 'produto':
            $columnName = 'codProduto';
            break;
        case 'fornecedor':
            $columnName = 'codFornecedor';
            break;
        default:
            break;
    }

    mysqli_query($conn, $query);

    mysqli_close($conn);

    echo "<script>window.location.href = window.location.pathname;</script>";
}
