<?php

class NightsWatch
{
    private $people;

    function recruit($person)
    {
        $this->people[] = $person;
    }

    function fight()
    {
        foreach ($this->people as $person)
        {
            if (method_exists($person, 'fight'))
                $person->fight();
        }
    }
}

?>