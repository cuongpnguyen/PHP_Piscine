<?php
$filename = '../htdocs/private/passwd';
$accounts = array();
if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] == 'OK')
{
    if (!file_exists($filename))
    {
        echo "ERROR file not exists\n";
        exit();
    }
    $contents = file_get_contents($filename);
    $accounts = unserialize($contents);
    /* Check if login exists*/
    foreach($accounts as $key => &$value)
    {
        if ($key == $_POST['login'])
        {
            if ($value == hash('md5',$_POST['oldpw']))
            {
                $value = hash('md5', $_POST['newpw']);
                file_put_contents($filename, serialize($accounts));
                echo "OK\n";
                exit();
            }
        }
    }
    echo "ERROR\n";
    exit();

}
else
{
    echo "ERROR\n";
}
?>