<?php
include_once("../../utils/index.php");

function deleteRow(string $nameTable, string $value)
{
    $conn = conectaBD();
    $pk = getPK($nameTable);

    $query = "DELETE FROM {$nameTable} WHERE {$pk} = '{$value}'";

    mysqli_query($conn, $query);

    mysqli_close($conn);
}
