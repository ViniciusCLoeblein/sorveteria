<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="page">
        <form method="POST" class="formLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>

            <label for="codUsuario">Usuario</label>
            <input name="codUsuario" type="text" placeholder="Digite seu usuário" autofocus required />

            <label for="password">Senha</label>
            <input name="password" type="password" placeholder="Digite sua senha" required />

            <input type="submit" value="Acessar" class="btn" />
        </form>
    </div>
    <?php
    include_once("../utils/index.php");
    logout();
    $conn = conectaBD();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codUsuario = $_POST["codUsuario"];
        $pass = $_POST["password"];

        $searchUser = "SELECT codUsuario FROM usuario
                WHERE codUsuario = {$codUsuario}";

        if (mysqli_num_rows(mysqli_query($conn, $searchUser)) == 0) {
            echo "<script>alert('Usuário não encontrado. Tente novamente.');</script>";
        } else {
            $verifyPass = "SELECT codUsuario, nome, indAdm from usuario
                           WHERE codUsuario = {$codUsuario} AND senha = '{$pass}'";

            $result = mysqli_query($conn, $verifyPass);

            if (mysqli_num_rows($result) == 0) {
                echo "<script>alert('A senha não confere.');</script>";
            } else {
                $user = mysqli_fetch_assoc($result);
                setcookie('usuario', json_encode($user), time() + (86400 * 15), "/");

                header("Location: /sorveteria/home");
                exit();
            }
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>