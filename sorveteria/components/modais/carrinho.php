<?php

function modalCarrinho()
{
    $items = isset($_COOKIE['carrinho']) ? json_decode($_COOKIE['carrinho'], true) : [];
?>

    <div class="fixed bottom-0 right-0 m-6">
        <?php if (!empty($items)) { ?>
            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="bg-blue-500 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-full text-2xl">
                Ver carrinho
            </button>
        <?php } ?>
    </div>

    <div id="crud-modal" tabindex="0" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Carrinho
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <table class="w-full text-sm text-left rounded-lg">
                    <thead class="text-xs text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Produto
                            </th>
                            <th scope="col">
                                Valor
                            </th>
                            <th scope="col">
                                Quantidade
                            </th>
                            <th scope="col" class="px-6">
                                Valor total
                            </th>
                        </tr>
                    </thead>
                    <form method="POST">
                        <input name="type" type="hidden" value="finalizaVenda" />

                        <input name="items" value="<?= htmlspecialchars(json_encode($items), ENT_QUOTES, 'UTF-8') ?>" type="hidden">
                        <?php foreach ($items as $codProduto => $item) { ?>
                            <tr class="hover:bg-gray-200 border-b">


                                <input name="codProduto" value="<?= $codProduto ?>" type="hidden">
                                <input name="desProduto" value="<?= $item["produto"] ?>" type="hidden">
                                <input name="valor" value="<?= $item["valor"] ?>" type="hidden">
                                <input name="quantidade" value="<?= $item["quantidade"] ?>" type="hidden">

                                <td class="px-6 py-4">
                                    <?php echo $item["produto"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $item["valor"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $item["quantidade"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                    $valorTotalProduto = $item["valor"] * $item["quantidade"];
                                    $valoresTotais[] = $valorTotalProduto;
                                    echo $valorTotalProduto;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                </table>
                <div class="p-2 flex justify-between">
                    <?php
                    $valorTotalGeral = array_sum($valoresTotais);
                    echo "<b class='pt-1 pl-2'>Total: $valorTotalGeral</b>";
                    ?>
                    <input name="valorTotal" value="<?= $valorTotalGeral ?>" type="hidden">
                    <div>
                        <button type="button" onclick="limparCarrinho()" class="font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:!bg-red-100">
                            Cancelar venda
                        </button>
                        <button type="submit" class="text-white inline-flex items-center !bg-violet-300 hover:!bg-violet-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Finalizar venda
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function limparCarrinho() {
            document.cookie = "carrinho=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

            window.location.href = '/sorveteria/home/';
        }
    </script>
<?php
}
