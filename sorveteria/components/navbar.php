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
    <nav class="bg-blue-100 border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../../assets/logo.jpg" class="h-8" alt="Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Sorvetes</span>
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <span class="material-symbols-outlined">
                    menu
                </span>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg g-blue-100 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="/sorveteria/home" class="menuAcesso block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:p-0" aria-current="page">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/sorveteria/pages/venda" class="menuAcesso block py-2 px-3 text-black bg-blue-700 rounded md:bg-transparent md:p-0" aria-current="page">
                            Vendas
                        </a>
                    </li>

                    <?php if ($permissao) { ?>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">
                                Cadastros
                                <span class="material-symbols-outlined">
                                    expand_more
                                </span>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="/sorveteria/pages/usuarios" class="menuAcesso block px-4 py-2 hover:bg-gray-100">
                                            Usuarios
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/pages/categorias" class="menuAcesso block px-4 py-2 hover:bg-gray-100">
                                            Categorias
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/pages/fornecedores" class="menuAcesso block px-4 py-2 hover:bg-gray-100">
                                            Fornecedores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/sorveteria/pages/produtos" class="menuAcesso block px-4 py-2 hover:bg-gray-100">
                                            Produtos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbarRel" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto">
                            Relatorios
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbarRel" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="/sorveteria/pages/relVendas" class="menuAcesso block px-4 py-2 hover:bg-gray-100">
                                        Vendas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/sorveteria/login" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
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
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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