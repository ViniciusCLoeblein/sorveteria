<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Venda </title>

    <link rel="stylesheet" href="../../main.css">

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
    include_once("../../components/card/index.php");
    include_once("../../components/modais/carrinho.php");
    include_once("../.Selects/index.php");

    $produtos = getProduto();

    navBar();
    ?>

    <div class="page h-full p-6">
        <?php card($produtos); ?>
        <?php modalCarrinho(); ?>
    </div>
</body>

</html>