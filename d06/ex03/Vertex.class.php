<?php
require_once('Color.class.php');
class Vertex
{
    private $_x;
    private $_y;
    private $_z;
    private $_w = 1.0;
    private $_color;
    static $verbose = False;

    function __construct($array)
    {
       // if (array_key_exists('x', $array) && array_key_exists('y', $array) && array_key_exists('z', $array))
       // {
            $this->_x = $array['x'];
            $this->_y = $array['y'];
            $this->_z = $array['z'];
       // }
        
       if (array_key_exists('w', $array))
        {
            $this->_w = $array['w'];
        }
        if (array_key_exists('color', $array))
        {
            $this->_color = $array['color'];
        }
        else
        {
            $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
        }
        $red = $this->_color->red;
        $green = $this->_color->green;
        $blue = $this->_color->blue;
        $str = sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f , Color( red: %4d, green: %4d, blue: %4d ) ) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $red, $green, $blue);
        
        if(self::$verbose)
        {
            print($str);
        }
    }

    function __destruct()
    {
        $red = $this->_color->red;
        $green = $this->_color->green;
        $blue = $this->_color->blue;
        $str = sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f , Color( red: %4d, green: %4d, blue: %4d ) ) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w, $red, $green, $blue);
        if(self::$verbose)
        {
            print($str);
        }
    }
    function __toString()
    {
        $str = sprintf("Vertex( x: %.2f, y: %.2f, z: %.2f, w: %.2f", $this->_x, $this->_y, $this->_z, $this->_w);
        if (self::$verbose == false)
        {
            $str .= " )";
            return ($str);   
        }
        if ($this->_color)
        {
            $red = $this->_color->red;
            $green = $this->_color->green;
            $blue = $this->_color->blue;
        $str .= ", Color( red: $red, green: $green, blue: $blue ) )";
        }
        return $str;
    }
    
    function doc()
    {
        $str = file_get_contents('Vertex.doc.txt');
        if ($str)
            echo $str;
        else
            print("Error : Vertex.doc doesn't exist\n");
        return ;
    }

   function get_x()
    {
        return $this->_x;
    }
    function get_y()
    {
        return $this->_y;
    }
    function get_z()
    {
        return $this->_z;
    }
    function get_w()
    {
        return $this->_w;
    }
    
    function set_x($val)
    {
        return $this->_x = $val;
    }
    function set_y($val)
    {
        return $this->_y = $val;
    }
    function set_z($val)
    {
        return $this->_z = $val;
    }
    function set_w($val)
    {
        return $this->_w = $val;;
    }
}
?>