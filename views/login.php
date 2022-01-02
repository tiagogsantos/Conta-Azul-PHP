<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/login.css">
    <title>Login Conta Azul</title>
</head>
<body>
    <div class="loginarea">
        <form method="post">
            <input type="email" name="email" placeholder="Digite seu e-mail">
            <input type="password" name="password" placeholder="Digite a sua senha">
            <button class="login" type="submit">Entrar</button> <br/>

            <?php if (isset($error) && !empty($error)): ?>
                <div class="warning">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>