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

function getProduto($adicionarFiltro = false)
{
    $conn = conectaBD();

    $filtro = ($adicionarFiltro) ? "WHERE a.estoque > 0" : "";

    $query = "SELECT
               a.codProduto as 'Produto',
               a.desProduto as 'Descrição',
               CONCAT('R$ ', REPLACE(FORMAT(a.valor, 2), '.', ',')) as 'Valor',
               a.valor as 'ValorD',
               a.estoque as 'Estoque',
               a.estoqueMinimo as 'Estoque Minimo',
               b.desFornecedor as 'Fornecedor',
               c.desCategoria as 'Categoria'
               FROM produto a
               INNER JOIN fornecedor b ON a.codFornecedor = b.codFornecedor
               INNER JOIN categoria c ON a.codCategoria = c.codCategoria
               $filtro
               ORDER BY (1)";

    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    return $result;
}

function getRelVendas()
{
    $conn = conectaBD();

    $query = "SELECT
               a.numCupom as 'numCupom',
               DATE_FORMAT(a.dtaVenda, '%d/%m/%Y') as 'Data Venda',
               d.desProduto as 'Produto',
               CONCAT('R$ ', REPLACE(FORMAT(a.valorTotal, 2), '.', ',')) as 'Valor Total',
               c.qtdProduto as 'Qtd Vendidos',
               b.nome as 'Vendedor'
               from Venda a
               INNER JOIN Usuario b on a.codUsuario = b.codUsuario
               INNER JOIN ItemVenda c on a.seq = c.vendaSeq
               INNER JOIN Produto d on c.codProduto = d.codProduto
               ORDER BY(1) DESC";

    $result = mysqli_query($conn, $query);

    mysqli_close($conn);

    return $result;
}
