<?php
include_once "modais/insert.php";
include_once "modais/delete.php";

function table(string $title, string $desc, array $columns, mysqli_result $data, string $tableName, array $inputsModal, array $selectModal = [])
{
    $perPage = 10;
    $currentPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

    $startIndex = ($perPage * $currentPage) - $perPage;
    $endIndex = $startIndex + $perPage;

    $totalItems = mysqli_num_rows($data);

    if ($endIndex > $totalItems) {
        $endIndex = $totalItems;
    }

    $totalPages = ceil($totalItems / $perPage);
?>
    <div class="relative overflow-x-auto sm:rounded-lg p-6 min-h-[75vh]">
        <table class="w-full text-sm text-left rounded-lg">
            <caption class="p-5 text-lg bg-violet-100 font-semibold text-left rounded-t-lg">
                <?php echo $title; ?>
                <p class="mt-1 text-sm font-normal text-gray-500">
                    <?php echo $desc; ?>
                </p>
                <?php modalInserir($tableName, $inputsModal, $selectModal) ?>
            </caption>

            <thead class="bg-violet-100 text-xs text-gray-700">
                <tr>
                    <?php foreach ($columns as $column) { ?>
                        <th scope="col" class="px-6 py-3">
                            <?php echo $column; ?>
                        </th>
                    <?php } ?>
                    <th scope="col">
                    </th>
                    <th scope="col">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rowNumber = 0;
                while ($rowNumber < $endIndex && $row = mysqli_fetch_assoc($data)) {
                    if ($rowNumber >= $startIndex) {
                ?>
                        <tr class="bg-violet-100 hover:bg-violet-200 border-b">
                            <?php foreach ($columns as $columnName) { ?>
                                <td class="px-6 py-4">
                                    <?php echo $row[$columnName]; ?>
                                </td>
                            <?php } ?>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-blue-600 hover:underline">Editar</a>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <?php modalDelete($tableName, $row[$columnName]) ?>
                            </td>
                        </tr>
                <?php
                    }
                    $rowNumber++;
                }
                ?>
            </tbody>
        </table>
        <nav class="bg-violet-100 flex items-center flex-column flex-wrap md:flex-row justify-between p-4 rounded-b-lg" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                <span class="font-semibold text-gray-900">Pagina <?php echo $currentPage; ?> de <?php echo $totalPages; ?> </span>

            </span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <?php if ($currentPage > 1) { ?>
                        <a href="?page=<?php echo max(1, $currentPage - 1); ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            Página anterior
                        </a>
                    <?php } else { ?>
                        <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-300 bg-white border border-gray-300 rounded-s-lg cursor-not-allowed">
                            Página anterior
                        </span>
                    <?php } ?>
                </li>
                <li>
                    <?php if ($currentPage < $totalPages) { ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            Próxima página
                        </a>
                    <?php } else { ?>
                        <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-300 bg-white border border-gray-300 rounded-e-lg cursor-not-allowed">
                            Próxima página
                        </span>
                    <?php } ?>
                </li>
            </ul>
        </nav>
    </div>
<?php
}
