<?php

class Color
{
    public $red;
    public $green;
    public $blue;
    static $verbose = False;

    function __construct($rgb)
    {
        if (array_key_exists("rgb", $rgb))
        {
            $val = $rgb['rgb'];
            $this->red = ($val >> 16) & 255;
            $this->green = ($val >> 8) & 255;
            $this->blue = $val & 255;
        }
        else if (array_key_exists("red", $rgb) && array_key_exists("green", $rgb) && array_key_exists("blue", $rgb))
        {
            $this->red = $rgb['red'];
            $this->green = $rgb['green'];
            $this->blue = $rgb['blue'];
        }
        if (self::$verbose)
            printf("Color( red: %4d, green:   %4d, blue:   %4d ) constructed.\n", $this->red, $this->green, $this->blue);
    }

    function __detruct()
    {
        if (self::$verbose)
            printf("Color( red: %4d, green:   %4d, blue:   %4d ) destructed.\n", $this->red, $this->green, $this->blue);
    }

    function doc()
    {
        $str = file_get_contents('Color.doc.txt');
        if ($str)
            echo $str;
        else
            print("Error : Color.doc doesn't exist");
        return ;
    }

    function __toString()
    {
        //$str = "Color( red: $this->red, green:   $this->green, blue:   $this->blue )";
        //return ($str);
        $str = sprintf("Color( red: %4d, green:   %4d, blue:   %4d )", $this->red, $this->green, $this->blue);
        return ($str);
    }

    function add(Color $rhs)
    {
        $arr = array('red' => $this->red + $rhs->red, 'green' => $this->green + $rhs->green, 'blue' => $this->blue + $rhs->blue);
        return new Color($arr);
    }

    function sub(Color $rhs)
    {
        $arr = array('red' => $this->red - $rhs->red, 'green' => $this->green - $rhs->green, 'blue' =>  $this->blue - $rhs->blue);
        return new Color($arr);
    }

    function mult($f)
    {
        $arr = array('red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f);
        return new Color($arr);
    }
}
?>