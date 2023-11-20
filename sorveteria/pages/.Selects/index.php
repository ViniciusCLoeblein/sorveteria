<?php
include_once("../../utils/index.php");

function getTable(string $nameTable, array $fields = ['*'], array $functions = [])
{
    $conn = conectaBD();

    $fieldsString = implode(', ', $fields);
    $functionsString = implode(', ', $functions);
    $functionsClause = !empty($functionsString) ? ", {$functionsString}" : '';

    $query = "SELECT {$fieldsString}{$functionsClause} FROM {$nameTable} ORDER BY (1)";

    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    return $result;
}

function getProduto()
{
    $conn = conectaBD();

    $query = "SELECT
               a.codProduto as 'Produto',
               a.desProduto as 'Descrição',
               CONCAT('R$ ', REPLACE(FORMAT(a.valor, 2), '.', ',')) as 'Valor',
               a.valor as 'ValorD',
               a.estoque as 'Estoque',
               a.estoqueMinimo as 'Estoque Minimo',
               b.desFornecedor as 'Fornecedor',
               c.desCategoria as 'Categoria'
                FROM produto a inner join fornecedor b
                    on a.codFornecedor = b.codFornecedor
                inner join categoria c
                    on a.codCategoria = c.codCategoria
                ORDER BY (1)
              ";

    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    return $result;
}
