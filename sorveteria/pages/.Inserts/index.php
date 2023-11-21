<?php
include_once("../../utils/index.php");
include_once("../.Selects/index.php");

function insertTable(string $nameTable, array $values, $seq = true)
{
    $conn = conectaBD();

    $valuesString = implode(", ", array_map(function ($value) {
        return "'" . addslashes($value) . "'";
    }, $values));

    if ($seq) {
        $maxseq = getMaxSequence($nameTable);
        $query = "INSERT INTO {$nameTable} VALUES ($maxseq, {$valuesString})";
    } else {
        $query = "INSERT INTO {$nameTable} VALUES ({$valuesString})";
    }

    mysqli_query($conn, $query);

    mysqli_close($conn);
}

function getMaxSequence(string $nameTable)
{
    $max = 0;
    $pk = getPK($nameTable);

    $queryResult = getTable($nameTable, [$pk], ["COALESCE(MAX($pk) + 1, 1) AS 'result'"]);

    if ($queryResult) {
        $row = mysqli_fetch_assoc($queryResult);
        $max = $row['result'];
    }

    return $max;
}

//venda

function adicionarAoCarrinho($codProduto, $desProduto, $valor)
{
    $carrinho = obterCarrinho();

    if (array_key_exists($codProduto, $carrinho)) {
        $carrinho[$codProduto]['quantidade']++;
    } else {
        $carrinho[$codProduto] = array(
            'produto' => $desProduto,
            'valor' => $valor,
            'quantidade' => 1
        );
    }
    atualizarCarrinho($carrinho);
}

function obterCarrinho()
{
    if (isset($_COOKIE['carrinho'])) {
        $carrinho = json_decode($_COOKIE['carrinho'], true);
    } else {
        $carrinho = isset($_COOKIE['carrinho']) ? json_decode($_COOKIE['carrinho'], true) : array();
    }

    return $carrinho;
}

function atualizarCarrinho($carrinho)
{
    setcookie('carrinho', json_encode($carrinho), time() + (86400 * 1), "/");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == 'InsertCarrinho') {
    $codProduto = $_POST["codProduto"];
    $desProduto = $_POST["desProduto"];
    $valor = $_POST["valor"];

    adicionarAoCarrinho($codProduto, $desProduto, $valor);

    echo "<script>window.location.href = window.location.pathname;</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == 'finalizaVenda') {
    $conn = conectaBD();
    //gera venda

    $query = getTable('Venda', ['numCupom'], ["COALESCE(MAX(numCupom) + 1, 1000) AS 'result'"]);
    $queryCupom = mysqli_fetch_assoc($query);
    $valorTotal = $_POST["valorTotal"];
    $usuarioData = json_decode($_COOKIE['usuario'], true);
    $codUsuario = $usuarioData['codUsuario'];
    $valuesVenda = [$queryCupom['result'], date('Y-m-d'), $valorTotal, $codUsuario];

    insertTable('venda', $valuesVenda);

    //items venda 
    $queryV = getTable('Venda', ['seq'], ["MAX(seq) AS 'result'"]);
    $queryVenda = mysqli_fetch_assoc($queryV);

    $items_json = $_POST["items"];
    $items = json_decode($items_json, true);

    foreach ($items as $codProduto => $item) {
        $queryP = "SELECT codProduto, estoque - {$item['quantidade']} AS 'result' from produto where codProduto = {$codProduto}";
        $result = mysqli_query($conn, $queryP);
        $queryProduto = mysqli_fetch_assoc($result);

        $queryAlterEstq = "UPDATE produto SET estoque = {$queryProduto['result']} where codProduto = {$codProduto}";
        mysqli_query($conn, $queryAlterEstq);

        $valuesItem = [$codProduto, $queryVenda['result'], $item["quantidade"]];
        insertTable('ItemVenda', $valuesItem, false);
    }

    mysqli_close($conn);

    setcookie('carrinho', '', time() - 3600, '/');

    echo "<script>window.location.href = '/sorveteria/home/';</script>";
}
