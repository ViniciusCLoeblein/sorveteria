<?php
include_once "../../cadastros/.Deletes/index.php";

function modalDelete(string $nameTable, string $value)
{
?>
    <form method="POST">
        <input type="hidden" name="type" value="delete">
        <input type="hidden" name="nameTable" value="<?= $nameTable ?>">
        <input type="hidden" name="value" value="<?= $value ?>">
        <button type="submit" class="font-medium text-red-600 hover:underline cursor-pointer">
            Excluir
        </button>
    </form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == "delete") {
        $nameTable = $_POST["nameTable"];
        $value = $_POST["value"];
        deleteRow($nameTable, $value);

        echo "<script>window.location.href = window.location.pathname;</script>";
    }
}
?>