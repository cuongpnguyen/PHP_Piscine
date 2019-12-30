<?php
$login  = "zaz";
$password = "Ilovemylittleponey";
if ($_SERVER['PHP_AUTH_USER'] == $login && $_SERVER['PHP_AUTH_PW'] == $password)
{
    ?>
    <html><body>Hello Zaz<br>
    <?php
        echo "<img src='data:image/png;base64, ";
        echo base64_encode(file_get_contents('img/42.png')) ."'>";
    ?>
    </body></html>
    <?php
}
else
{
    ?>
    <html><body>That area is accessible for members only</body></html>
<?php
    header('HTTP/1.0 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Member area"');
}
?>