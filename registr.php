<?php

if (isset($_POST['registr'])){
    if (!empty($_POST['username'])){
        $username = $_POST['username'];
    } else $errors[] = 'Введите логин';
    if (!empty($_POST['pass'])){
    } else $errors[] = 'Введите пароль';
    if (($_POST['pass'] == $_POST['pass2']) && (!empty ($_POST['pass']))){
        $pass = $_POST['pass'];
    } else $errors[] = 'Пароли не совпадают';
    if (preg_match('/^([A-Za-z0-9_-]+\.)*[A-Za-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])){
        $email = $_POST['email'];
    } else $errors[]='Некорректный email';


    if (isset($errors) == 1){
        foreach ($errors as $value){
            echo "<p style='color:red'>". $value."<br>";
        }
    } else {
        $db = new mysqli('localhost', 'Krun', 'Koska200895', 'testsite');

        $sql = "SELECT username, password, email FROM users WHERE username='$username' or email='$email'";
        $result = $db -> query($sql);

        if (mysqli_num_rows($result) == 0){
            session_start();
            $pass = sha1($pass);

            $rec = "INSERT INTO users (username, password, email) VALUES ('$username', '$pass', '$email')";
            $res = $db ->query($rec);
            $db->close();
            $_SESSION['user'] = $username;

            echo 'Вы зарегистрированы!!!';

            header("location: index.php");
        } else echo 'Такой пользователь уже существует';

    }
}


?>


<h3>Регистрация на сайте</h3>
<form action="registr.php" method="post">
    <fieldset>
        <label for="username">Введите логин: </label>
        <input type="text" name="username" id="username" required>
        <label fot="pass">Введите пароль: </label>
        <input type="text" name="pass" id="pass" required>
        <label fot="pass2">Введите пароль повторно: </label>
        <input type="text" name="pass2" id="pass2" required>
        <label fot="email">Введите email: </label>
        <input type="email" name="email" id="email" required>
        <input type="submit" id="registr" name="registr" value="Регистрация">
    </fieldset>
</form>
<a href="index.php">На главную</a>