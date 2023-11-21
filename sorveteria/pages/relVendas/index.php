<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title> Relatorio de Vendas </title>

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

    $tableName = 'venda';
    $title = 'Relatorio Vendas';
    $desc = 'Navegue por uma lista do relatorio de vendas projetados para ajudá-lo a trabalhar e manter-se organizado.';

    $columns = ['numCupom', 'Data Venda', 'Produto', 'Qtd Vendidos', 'Vendedor', 'Valor Total'];
    $data = getRelVendas();
    $modalInputs = [
        [
            'label' => 'Descrição',
            'type' => 'text',
            'placeholder' => 'Insira a descrição da categoria',
            'required' => true
        ],
    ];

    navBar();
    table($title, $desc, $columns, $data, $tableName, $modalInputs);

    ?>

</body>

</html>