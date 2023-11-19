<?php
include_once("../../utils/index.php");

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
            $query = "UPDATE categoria
                      SET desCategoria = '{$_POST["Descrição"]}'
                      WHERE codCategoria = '{$_POST["id"]}'
                    ";
            break;
        case 'produto':
            $query = "UPDATE produto
                      SET desProduto = '{$_POST["Descrição"]}',
                          valor = '{$_POST["Valor"]}',
                          estoque = '{$_POST["Estoque"]}',
                          estoqueMinimo = '{$_POST["Estoque_Minimo"]}',
                          codFornecedor = '{$_POST["Fornecedor"]}',
                          codCategoria = '{$_POST["Categoria"]}'
                      WHERE codProduto = '{$_POST["id"]}'
                    ";
            break;
        case 'fornecedor':
            $query = "UPDATE fornecedor
                      SET desFornecedor = '{$_POST["Descrição"]}',
                          cnpj = '{$_POST["cnpj"]}',
                          numContato = '{$_POST["Numero_contato"]}',
                          estado = '{$_POST["estado"]}'
                      WHERE codFornecedor = '{$_POST["id"]}'
                    ";
            break;
        default:
            break;
    }

    mysqli_query($conn, $query);

    mysqli_close($conn);

    echo "<script>window.location.href = window.location.pathname;</script>";
}
