<?php
include_once("../../utils/index.php");
include_once("../.Selects/index.php");

function insertTable(string $nameTable, array $values)
{
    $conn = conectaBD();

    $valuesString = implode(", ", array_map(function ($value) {
        return "'" . addslashes($value) . "'";
    }, $values));

    $seq = getMaxSequence($nameTable);

    $query = "INSERT INTO {$nameTable} VALUES ($seq, {$valuesString})";

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
