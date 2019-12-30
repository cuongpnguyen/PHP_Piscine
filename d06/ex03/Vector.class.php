<?php
require_once('Vertex.class.php');
class Vector
{
    private $_x = 0;
    private $_y = 0;
    private $_z = 0;
    private $_w = 1.0;
    static $verbose = False;

    function __construct($array)
    {
       if (array_key_exists('orig', $array) && $array['orig'] instanceof Vertex)
            $orig = new Vertex(array('x' => $array['orig']->get_x(), 'y' => $array['orig']->get_y(), 'z' => $array['orig']->get_z()));
        else
            $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
        if(array_key_exists('dest', $array) && $array['dest'] instanceof Vertex)
        {
            $dest = $array['dest'];
            $this->_x = $dest->get_x() - $orig->get_x();
            $this->_y = $dest->get_y() - $orig->get_y();
            $this->_z = $dest->get_z() - $orig->get_z();
            $this->_w = 0;
        }
        $str = sprintf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f) constructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        if(self::$verbose)
        {
            print($str);
        }
    }

    function __destruct()
    {
        $str = sprintf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f) destructed\n", $this->_x, $this->_y, $this->_z, $this->_w);
        if(self::$verbose)
        {
            print($str);
        }
    }
    function __toString()
    {
        $print_x = number_format($this->_x, 2);
        $print_y = number_format($this->_y, 2);
        $print_z = number_format($this->_z, 2);
        $print_w = number_format($this->_w, 2);
        $str = sprintf("Vector( x: %.2f, y: %.2f, z: %.2f, w: %.2f", $this->_x, $this->_y, $this->_z, $this->_w);
     //   if (self::$verbose == false)
     //   {
            $str .= ").";
            return ($str);   
      //  }
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

    function magnitude()
    {
        return (float) sqrt($this->_x ** 2 + $this->_y ** 2 + $this->_z ** 2);
    }
    
    function normalize()
    {
        $mag = $this->magnitude();
        if ($mag == 1)
            return clone $this;
        $vert = new Vertex(array('x' => number_format($this->_x / $mag, 2), 'y' => number_format($this->_y / $mag, 2), 'z' => number_format($this->_z / $mag, 2)));
        return new Vector(array('dest' => $vert));
    }

    function add($rhs)
    {
    
        $sumOfVector = new Vector(array('dest' => new Vertex (array('x' => $this->_x + $rhs->_x, 'y' => $this->_y + $rhs->_y,'z' => $this->_z + $rhs->_z))));
        return $sumOfVector;
    }

    function sub($rhs)
    {
        $subOfVector = new Vector(array('dest' => new Vertex (array('x' => $this->_x - $rhs->_x, 'y' => $this->_y - $rhs->_y,'z' => $this->_z - $rhs->_z))));
        return $subOfVector;
    }

    function opposite()
    {
        $opposite = new Vector(array('dest' => new Vertex (array('x' => $this->get_x() * -1, 'y' => $this->get_y() * -1,'z' => $this->get_z() * -1))));
        return $opposite;
    }

    function scalarProduct($k)
    {
        $scalar = new Vector(array('dest' => new Vertex (array('x' => $this->get_x() * $k, 'y' => $this->get_y() * $k,'z' => $this->get_z() * $k))));
        return $scalar;
    }

    function dotProduct($rhs)
    {
        $dot = $this->get_x() * $rhs->get_x() + $this->get_y() * $rhs->get_y() + $this->get_z() * $rhs->get_z();
        return $dot;
    }

    function cos($rhs)
    {
        $ab = $this->get_x() * $rhs->get_x() + $this->get_y() * $rhs->get_y() + $this->get_z() * $rhs->get_z();
        $mag_a = sqrt($this->get_x() ** 2 + $this->get_y() ** 2 + $this->get_z() ** 2);
        $mag_b = sqrt($rhs->get_x() ** 2 + $rhs->get_y() ** 2 + $rhs->get_z() ** 2);

        return (float) $ab / ($mag_a * $mag_b);

    }
    
    function crossProduct($rhs)
    {
        $cx = $this->get_y() * $rhs->get_z() -  $this->get_z() * $rhs->get_y();
        $cy = $this->get_z() * $rhs->get_x() -  $this->get_x() * $rhs->get_z();
        $cz = $this->get_x() * $rhs->get_y() -  $this->get_y() * $rhs->get_x();
        $cross = new Vector(array('dest' => new Vertex (array('x' => $cx, 'y' => $cy,'z' => $cz))));
        return $cross;
    }
}
?>