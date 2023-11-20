<?php
include_once "../../pages/.Inserts/index.php";

function card(mysqli_result $produtos)
{
?>
    <div class="flex flex-wrap -mx-4">
        <?php foreach ($produtos as $produto) { ?>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/3 px-4 mb-8">
                <form method="POST" class="bg-white border border-gray-200 rounded-lg shadow">
                    <input name="type" type="hidden" value="InsertCarrinho" />
                    <input name="codProduto" type="hidden" value="<?= $produto["Produto"] ?>" />
                    <input name="desProduto" type="hidden" value="<?= $produto["Descrição"] ?>" />
                    <input name="valor" type="hidden" value="<?= $produto["ValorD"] ?>" />
                    <a href="#" class="cursor-default">
                        <?php if ($produto["Categoria"] == 'Sorvetes') { ?>
                            <img class="p-4 rounded-t-lg w-full h-80" src="https://cptstatic.s3.amazonaws.com/imagens/enviadas/materias/materia11042/slide/sorvetes1-cursos-cpt.jpg" alt="imagem do produto" />
                        <?php } elseif ($produto["Categoria"] == 'Coberturas') { ?>
                            <img class="p-4 rounded-t-lg w-full h-80" src="https://www.gemelli.com.br/wp-content/uploads/cobertura.png" alt="imagem do produto" />
                        <?php } else { ?>
                            <img class="p-4 rounded-t-lg w-full h-80" src="https://cdn.ready-market.ai/101/bac6eec5//Templates/pic/850-spoon-all.jpg?v=57b1f787" alt="imagem do produto" />
                        <?php } ?>
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-xl font-semibold tracking-tight text-gray-900">
                                <?php echo $produto["Descrição"] ?>
                            </h5>
                        </a>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900">
                                <?php echo $produto["Valor"] ?>
                            </span>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Add carrinho
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
<?php
}
?>