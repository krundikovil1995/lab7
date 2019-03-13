<?php

$url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$date = date('Y-m-d H:i', time());
date_default_timezone_set('UTC');

if (isset($_COOKIE['address'])){
    $count = count($_COOKIE['address']);
    $count = $count+1;
    setcookie("address[$count]", $url);
    setcookie("time[$count]", $date);
} else {
    setcookie("address[0]", $url);
    setcookie("time[0]", $date);
}

if (isset($_POST['history'])){
    if (isset($_COOKIE['address']) && (isset($_COOKIE['time']))){
        foreach ($_COOKIE['address'] as $value){
            $res['adr'][] = $value;
        }
        foreach ($_COOKIE['time'] as $value){
            $res['time'][] = $value;
        }
    }
    foreach ($res['adr'] as $key=>$value){
        echo $value." - ";
        echo $res['time'][$key]."<br>";
    }
}

?>

<form action="index.php" method="post">
    <input type="submit" value="Посмотреть историю" name="history">
</form>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TITLE</title>
</head>
<body>

<?php session_start(); if (!isset ($_SESSION['user']) && !empty($_COOKIE['login'])){
 $login = $_COOKIE['login'];

 $db = new mysqli('localhost', 'Krun', 'Koska200895', 'testsite');
 $sql = "SELECT * FROM users WHERE username='$login'";
 $result = $db->query($sql);

 if (mysqli_num_rows($result) != 0){
     $_SESSION['user'] = $login;
 }
}

if(isset($_SESSION['user'])){ ?>
<h2>Добро пожаловать, <?php echo $_SESSION['user']; ?></h2>
    <form action="exit.php" method="post">
        <input type="submit" value="выход" name="exit">
    </form>
<?php } else if (!empty($_COOKIE['login'])){
 $login = $_COOKIE['login'];

 $db = new mysqli('localhost', 'Krun', 'Koska200895', 'testsite');
 $sql = "SELECT * FROM users WHERE username='$login'";
 $result = $db->query($sql);

 if (mysqli_num_rows($result) != 0){
     session_start();
     $_SESSION['user'] = $login;
 }

} else { ?>
<h3>Вход на сайт</h3>
<form action="login.php" method="post">
    <fieldset>
        <label for="username">Введите логин: </label>
        <input type="text" name="username" id="username">
        <label fot="pass">Введите пароль: </label>
        <input type="password" name="pass" id="pass">
        <input name="remember" type="checkbox" value="1"> Запомнить меня
        <button type="submit" name="log"> Войти </button>
    </fieldset>
</form>
<a href="registr.php">Зарегистрироваться</a>

<?php } ?>

</body>
</html>
