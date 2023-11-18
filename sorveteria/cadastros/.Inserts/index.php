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

    if ($nameTable == 'usuario') {
        $queryResult = getTable($nameTable, ['codUsuario'], ["MAX(codUsuario + 1) AS 'result'"]);

        if ($queryResult) {
            $row = mysqli_fetch_assoc($queryResult);
            $max = $row['result'];
        }
    }

    return $max;
}
