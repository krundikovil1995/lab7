<?php


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TITLE</title>
</head>
<body>
<?php session_start(); if(isset($_SESSION['user'])){ ?>
<h2>Добро пожаловать, <?php echo $_SESSION['user']; ?></h2>
    <form action="exit.php" method="post">
        <input type="submit" value="выход" name="exit">
    </form>
<?php } else { ?>
<h3>Вход на сайт</h3>
<form action="login.php" method="post">
    <fieldset>
        <label for="username">Введите логин: </label>
        <input type="text" name="username" id="username">
        <label fot="pass">Введите пароль: </label>
        <input type="text" name="pass" id="pass">
        <button type="submit" name="log"> Войти </button>
    </fieldset>
</form>
<a href="registr.php">Зарегистрироваться</a>

<?php } ?>

</body>
</html>
