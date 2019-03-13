<?php

$url = $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];

if (isset($_COOKIE['address'])){
    $count = count($_COOKIE['address']);
    setcookie("address[$count]", $url);
} else {
    setcookie("address[0]", $url);
}

?>
<?php

if (isset($_POST['exit'])){
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("location: index.php");

    setcookie('login', '', time()-3600);

}

?>