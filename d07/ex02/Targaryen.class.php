<?php

class Targaryen
{
    function getBurned()
    {
        if (method_exists($this, 'resistsFire'))
        {
            if ($this->resistsFire())
                return "emerges naked but unharmed";
        }
        else
            return "burns alive";
    }
}

?>