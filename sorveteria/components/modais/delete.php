<?php
include_once "../../cadastros/.Deletes/index.php";

function modalDelete(string $nameTable, string $value)
{
?>
    <a href="#" class="font-medium text-red-600 hover:underline" data-modal-target="popup-modal" data-modal-toggle="popup-modal">
        Excluir
    </a>

    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Você tem certeza que deseja excluir este registro?
                    </h3>
                    <button onclick="confirmDelete('<?php echo $nameTable; ?>', '<?php echo $value; ?>')" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        Sim, tenho certeza
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        Não, cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(nameTable, value) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../cadastros/.Deletes/index.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        if (xhr.responseText.trim() !== '') { // Verifique se a resposta não está vazia
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                console.log(response.message);
                                // Atualize a página ou faça outras ações necessárias
                            } else {
                                console.error(response.message);
                                // Trate o erro de alguma forma
                            }
                        } else {
                            console.error('Resposta vazia do servidor.');
                        }
                    } else {
                        console.error('Erro na solicitação AJAX.');
                    }
                }
            };
            xhr.send("nameTable=" + nameTable + "&value=" + value);
        }
    </script>
<?php
}
?>