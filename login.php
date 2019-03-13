<?php


if (isset($_POST['log'])){
    if (!empty($_POST['username'])){
        $user = trim($_POST['username'], '');
    } else echo 'Введите имя'."<br>";
    if (!empty($_POST['pass'])){
        $pass = trim($_POST['pass'], '');
    } else echo "Введите пароль";

    if (!empty($user) && !empty($pass)){
        $db = new mysqli('localhost', 'Krun', 'Koska200895', 'testsite');

        $pass = sha1($pass);

        $sql = "SELECT username, password FROM users WHERE username='$user' and password='$pass'";

        $result = $db->query($sql);

        if (mysqli_num_rows($result) != 0){
            session_start();
            $_SESSION['user'] = $user;

            if (!empty($_POST['remember']) && $_POST['remember'] == 1){
                setcookie('login', $user, time()+ 60*60*24*30);
            }


            header("location: index.php");
        } else {
            echo 'Такого пользователя не существует';
            echo "<br><a href='registr.php'>".'Зарегистрироваться'."</a>";
        }
    } else header("refresh:2, url=index.php");

}


?>