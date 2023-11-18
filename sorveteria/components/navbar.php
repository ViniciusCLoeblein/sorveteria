<?php
function navBar()
{
    $userCookie = $_COOKIE['usuario'];
    $user = json_decode($userCookie, true);
    $permissao = $user['indAdm'] == 1 ? true : false;

    if ($user['nome'] == null) {
        header("Location: /sorveteria/login");
        exit();
    }
?>
    <nav class="bg-blue-100 border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="data:image/jpeg;base64,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" class="h-8" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Sorvetes</span>
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg g-blue-100 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="/sorveteria/home/" class="menuAcesso block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:p-0 md:dark:text-blue-500 md:dark:bg-transparent " aria-current="page">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menuAcesso block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:p-0 md:dark:text-blue-500 md:dark:bg-transparent" aria-current="page">
                            Vendas
                        </a>
                    </li>

                    <?php
                    if ($permissao) {
                    ?>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                Cadastros <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="/sorveteria/cadastros/usuarios/" class="menuAcesso block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/cadastros/categorias/" class="menuAcesso block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Categorias
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/cadastros/fornecedores/" class="menuAcesso block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Fornecedores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/cadastros/produtos/" class="menuAcesso block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Produtos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php
                    }
                    ?>

                    <li>
                        <a href="/sorveteria/login/" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            Sair
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
<?php
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menus = document.getElementsByClassName('menuAcesso')

        for (var i = 0; i < menus.length; i++) {
            if (menus[i].getAttribute('href') === window.location.pathname) {
                menus[i].classList.add('text-blue-700');
            }
        }
    });
</script>