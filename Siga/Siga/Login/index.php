<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <br>

        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">

        <br>

        <button type="submit" value="enviar">Entrar</button>
    </form>
</body>
</html>