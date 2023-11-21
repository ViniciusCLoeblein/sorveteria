<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Produtos </title>

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

    $tableName = 'produto';
    $title = 'Fornecedores';
    $desc = 'Navegue por uma lista de fornecedores projetados para ajudá-lo a trabalhar e manter-se organizado.';
    $columns = [
        'Produto',
        'Descrição',
        'Valor',
        'Estoque',
        'Estoque Minimo',
        'Fornecedor',
        'Categoria'
    ];
    $data = getProduto();

    $modalInputs = [
        [
            'label' => 'Descrição',
            'type' => 'text',
            'placeholder' => 'Insira a descrição',
            'required' => true
        ],
        [
            'label' => 'Valor',
            'type' => 'text',
            'placeholder' => 'Insira o valor',
            'required' => true
        ],
        [
            'label' => 'Estoque',
            'type' => 'number',
            'placeholder' => 'Insira o estoque',
            'required' => true
        ],
        [
            'label' => 'Estoque Minino',
            'type' => 'number',
            'placeholder' => 'Insira o estoque minino',
            'required' => true
        ],
    ];

    $modalSelects = [
        [
            'label' => 'Fornecedor',
            'options' => []
        ],
        [
            'label' => 'Categoria',
            'options' => []
        ]
    ];

    foreach (getTable('fornecedor') as $fornecedor) {
        $modalSelects[0]['options'][] = [
            'value' => $fornecedor['codFornecedor'],
            'placeholder' => $fornecedor['desFornecedor']
        ];
    }

    foreach (getTable('categoria') as $categoria) {
        $modalSelects[1]['options'][] = [
            'value' => $categoria['codCategoria'],
            'placeholder' => $categoria['desCategoria']
        ];
    }


    navBar();
    table($title, $desc, $columns, $data, $tableName, $modalInputs, $modalSelects);

    ?>

</body>

</html>