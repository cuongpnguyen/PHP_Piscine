<?php

$filename = '../htdocs/private/passwd';
$accounts = array();
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == 'OK')
{
    if (!file_exists($filename))
    {
        if(!file_exists('../htdocs'))
            mkdir('../htdocs');
        if (!file_exists('../htdocs/private'))
            mkdir('../htdocs/private');
        $tmp = array();
        $hashed_pass = hash('md5', $_POST['passwd']);
        $tmp[$_POST['login']] = $hashed_pass;
        file_put_contents($filename, serialize($tmp));
        echo "OK\n";
    }
    else
    {
        $contents = file_get_contents($filename);
        $accounts = unserialize($contents);
        foreach($accounts as $key => $value)
        {
            if ($key == $_POST['login'])
            {
                echo "ERROR\n";
                exit();
            }
        }
        $accounts[$_POST['login']] = hash('md5', $_POST['passwd']);
        file_put_contents($filename, serialize($accounts));
        echo "OK\n";
    }
}
else{
    echo "ERROR\n";
}
