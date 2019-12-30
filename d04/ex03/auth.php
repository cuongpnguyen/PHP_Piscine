<?php
function auth($login, $passwd)
{
    $filename = '../htdocs/private/passwd';
    $accounts = array();
    if (!file_exists($filename))
    {
        return False;
    }
    $contents = file_get_contents($filename);
    $accounts = unserialize($contents);
    foreach ($accounts as $key => $value)
    {
        if($key == $login && hash(md5, $passwd) == $value)
        {
            return True;
        }
    }
    return False;
}
?>