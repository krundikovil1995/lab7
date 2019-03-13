<?php

if (isset($_POST['exit'])){
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("location: index.php");

    setcookie('login', '', time()-3600);

}

?>