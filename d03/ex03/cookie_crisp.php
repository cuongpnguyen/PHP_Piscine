<?php
$action = $_GET['action'];
$name = $_GET['name'];
$value = $_GET['value'];

if($action == "set")
{
    setcookie($name, $value);
}
else if ($action == "get")
{
    echo $_COOKIE[$name];
}
else
{
    setcookie($name, '');
}
?>