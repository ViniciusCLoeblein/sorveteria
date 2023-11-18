<?php
include_once("../../utils/index.php");

function deleteRow(string $nameTable, string $value)
{
    $conn = conectaBD();
    $pk = getPK($nameTable);

    $query = "DELETE FROM {$nameTable} WHERE {$pk} = '{$value}'";

    
    header('Content-Type: application/json');
    if (mysqli_query($conn, $query)) {
        mysqli_close($conn);
        return 'Registro excluído com sucesso.';
    } else {
        mysqli_close($conn);
        return 'Erro ao excluir o registro: ' . mysqli_error($conn);
    }
}

function getPK(string $nameTable)
{
    $pk = '';
    if ($nameTable == 'usuario') {
        $pk = 'codUsuario';
    }

    return $pk;
}
