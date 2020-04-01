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
                    <input type="hidden" name="type" value="login">
                    <div class="boxSuccess">
                         <font color='green'>
                        <?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); } ?>
                        <?php if(isset($_SESSION['logout'])) { echo $_SESSION['logout']; unset($_SESSION['logout']); } ?>
                        </font>
                        <font color='red'>
                        <?php if(isset($_SESSION['error'][4])) { echo $_SESSION['error'][4]; } unset($_SESSION['error']) ?>
                        </font>
                    </div>
                        <input type="email" name="email" id="email" placeholder="Digite seu email">
                        <input type="password" name="password" id="password" placeholder="Sua senha">
                        <button class="btn btn-success">Entrar</button>
                        <a class="register" href="register.php">Cadastrar</a>
                </form>
            </div>
    </div>
</body>
</html>