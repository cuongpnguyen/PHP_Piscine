<?php
    include 'auth.php';
    session_start();
    if ($_GET['login'] && $_GET['passwd'])
    {
        if (auth($_GET['login'], $_GET['passwd']))
        {
            echo "OK\n";
            $_SESSION['logged_on_user'] = $_GET['login'];
            exit();
        }
        else
        {
            echo "ERROR\n";
            exit();
        }
    }
    else
    {
        echo "ERROR\n";
        exit();
    }
?>