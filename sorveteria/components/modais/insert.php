<?php
include_once("../../cadastros/.Inserts/index.php");


function modalInserir(string $tableName, array $inputs, array $selects = [])
{
?>
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="mt-4 py-1 px-4 !bg-violet-200 hover:!bg-violet-300 rounded-lg" type="button">
        Inserir
    </button>

    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Criar novo registro
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">

                        <!-- inputs -->
                        <input type="hidden" name="type" value="insert">
                        <?php foreach ($inputs as $input) : ?>
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900">
                                    <?= $input['label'] ?>
                                </label>
                                <input name="<?= $input['label'] ?>" type="<?= $input['type'] ?>" placeholder="<?= $input['placeholder'] ?>" required="<?= $input['required'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        <?php endforeach; ?>

                        <!-- selects -->
                        <?php foreach ($selects as $select) : ?>
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">
                                    <?= $select['label'] ?>
                                </label>
                                <select name="<?= $select['label'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <?php foreach ($select['options'] as $option) : ?>
                                        <option value="<?= $option['value'] ?>">
                                            <?= $option['placeholder'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <button type="submit" class="text-white inline-flex items-center !bg-violet-300 hover:!bg-violet-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Adicionar novo registro
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" &&  $_POST["type"] == "insert") {
        $values = [];

        switch ($tableName) {
            case 'usuario':
                $nome = $_POST["Nome"];
                $sobrenome = $_POST["Sobrenome"];
                $cpf = $_POST["CPF"];
                $dtaNasc = $_POST["dtaNascimento"];
                $indAdm = $_POST["Adminstrador"];
                $pswd = new DateTime($_POST["dtaNascimento"]);

                $values = [$nome, $sobrenome, $cpf, $dtaNasc, $indAdm, $pswd->format('d/m/Y')];
                break;
            case 'categoria':
                $desc = $_POST["Descrição"];
                $values = [$desc];
                break;
            case 'produto':
                $desc = $_POST["Descrição"];
                $valor = $_POST["Valor"];
                $estoque = $_POST["Estoque"];
                $estoqueMinino = $_POST["Estoque_Minino"];
                echo json_encode($_POST);
                $fornecedor = $_POST["Fornecedor"];
                $categoria = $_POST["Categoria"];
                $values = [$desc, $valor, $estoque, $estoqueMinino, $fornecedor, $categoria];
                break;
            case 'fornecedor':
                $desc = $_POST["Descrição"];
                $numContato = $_POST["N_contato"];
                $cnpj = $_POST["CNPJ"];
                $estado = $_POST["Estado"];
                $values = [$desc, $numContato, $cnpj, $estado];
                break;
            default:
                break;
        }

        insertTable($tableName, $values);

        echo "<script>window.location.href = window.location.pathname;</script>";
    }
}
?>