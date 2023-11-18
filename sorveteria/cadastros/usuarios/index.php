<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Usuarios </title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    include_once("../../components/navbar.php");
    include_once("../../components/table.php");
    include_once("../.Selects/index.php");

    $categorias = getTable("fornecedor");


    $tableName = 'usuario';
    $title = 'Usuários';
    $desc = 'Navegue por uma lista de usuários projetados para ajudá-lo a trabalhar e manter-se organizado.';
    $columns = ['Usuário', 'nome', 'CPF', 'Data nascimento', 'Administrador'];
    $data = getTable(
        $tableName,
        [
            '
             codUsuario as "Usuário",
             nome,
             CPF,
             DATE_FORMAT(dtaNascimento, "%d/%m/%Y") as "Data nascimento",
             indAdm as "Administrador"
            '
        ],
    );
    $modalInputs = [
        [
            'label' => 'Nome',
            'type' => 'text',
            'placeholder' => 'Insira o nome',
            'required' => true
        ],
        [
            'label' => 'Sobrenome',
            'type' => 'text',
            'placeholder' => 'Insira o sobrenome completo',
            'required' => true
        ],
        [
            'label' => 'CPF',
            'type' => 'number',
            'placeholder' => 'Insira o cpf',
            'required' => true
        ],
        [
            'label' => 'dtaNascimento',
            'type' => 'date',
            'placeholder' => '',
            'required' => true
        ],
        [
            'label' => 'Adminstrador',
            'type' => 'number',
            'placeholder' => 'Insira 0 ou 1',
            'required' => true
        ],
    ];


    navBar();
    table($title, $desc, $columns, $data, $tableName, $modalInputs);
    ?>

</body>

</html>