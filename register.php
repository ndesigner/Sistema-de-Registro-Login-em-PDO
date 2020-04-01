<?php if(!session_start()) { session_start(); } ?>

<!DOCTYPE html>
<html lang="pt/BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NPanel">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="assets/styles/default.css?<?= filectime("assets/styles/default.css"); ?>" type="text/css">
    <link rel="stylesheet" href="assets/styles/normalize.css?<?= filectime("assets/styles/normalize.css"); ?>" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>NPanel</title>
</head>
<body>
    <div class="container">
        <div class="logo"></div>
            <div class="box">
                <form action="assets/class/user.class.php" method="post">
                    <div class="boxErrors">
                        <font color='red'>
                        <?php if(isset($_SESSION['error'][1])) { echo $_SESSION['error'][1]; }
                        if(isset($_SESSION['error'][2])) { echo $_SESSION['error'][2]; }
                        if(isset($_SESSION['error'][3])) { echo $_SESSION['error'][3]; }
                        if(isset($_SESSION['error'][4])) { echo $_SESSION['error'][4]; } unset($_SESSION['error']) ?>
                        </font>
                    </div>
                    <input type="hidden" name="type" value="register">
                    <input type="text" name="name" id="name" placeholder="Digite seu nome completo" class="<?= !isset($_SESSION['error'][1]) ? '' : 'error' ?>">
                    <input type="email" name="email" id="email" placeholder="Digite seu email">
                    <input type="password" name="password" id="password" placeholder="Sua senha" class="<?= isset($_SESSION['error'][2]) ? 'error' : '' ?>">
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirme sua senha" class="<?= !isset($_SESSION['error'][2]) ? '' : 'error' ?>">
                    <button class="btn btn-primary">Cadastrar</button>
                <a class="register" href="index.php">Voltar</a>
                </form>
            </div>
    </div>
</body>
</html>