<?php
require_once('Matrix.class.php');
require_once('Vector.class.php');
require_once('Vertex.class.php');
require_once('Color.class.php');

class Camera
{
    private $tT;
   // private $tR;
    private $tR_mult;
    private $proj;
    private $origin;
    private $orientation;
    private $height;
    private $width;
    private $fov;
    private $near;
    private $far;

    public $matrix;
    static $verbose = False;
    const IDENTITY = "IDENTITY";
    const TRANSLATION = "TRANSLATION";
    const SCALE = "SCALE";
    const PROJECTION = "PROJECTION";
    const RX = "RX";
    const RY = "RY";
    const RZ = "RZ";

    function __construct($array)
    {
        $this->assign_var($array);
        //get opposite of vector
        $tmp_vector = new Vector (array('dest' => $this->origin));
        $opposite = $tmp_vector->opposite();
        $this->tT = new Matrix(array('preset' => Matrix::TRANSLATION, 'vtc' => $opposite));
        $this->tR_mult = ($this->orientation)->mult($this->tT);
        $this->proj = new Matrix( array( 'preset' => Matrix::PROJECTION,
        'fov' => $this->fov,
        'ratio' => $this->width / $this->height,
        'near' => $this->near,
        'far' => $this->far));
        if (self::$verbose)
        {
            print("Camera instance created\n");
        }
    }
    function assign_var($array)
    {
        if (array_key_exists('origin', $array))
            $this->origin = $array['origin'];
        if (array_key_exists('orientation', $array))
            $this->orientation = $array['orientation'];
        if (array_key_exists('height', $array))
            $this->height = $array['height'];
        if (array_key_exists('width', $array))
            $this->width = $array['width'];
        if (array_key_exists('fov', $array))
            $this->fov = $array['fov'];
        if (array_key_exists('near', $array))
            $this->near = $array['near'];
        if (array_key_exists('far', $array))
            $this->far = $array['far'];
    }

    function doc()
    {
        $str = file_get_contents('Camera.doc.txt');
        if ($str)
            echo $str;
        else
            print("Error : Camera.doc.txt doesn't exist\n");
        return ;
    }

    function __destroy()
    {
        if (self::$verbose)
        {
            print("Camera instance destroyed\n");
        }
    }

    function print_Matrix($m)
    {
        $str = "M | vtcX | vtcY | vtcZ | vtxO\n";
        $str .= "-----------------------------\n";
        $str .= "x";
        for ($x = 0; $x < 4; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$m[$x]);
            if ($x == 3)
                $str .= "\n";
        }
        $str .= "y";
        for ($x = 4; $x < 8; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$m[$x]);
            if ($x == 7)
                $str .= "\n";
        }
        $str .= "z";
        for ($x = 8; $x < 12; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$m[$x]);
            if ($x == 11)
                $str .= "\n";
        }
        $str .= "w";
        for ($x = 12; $x < 16; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$m[$x]);
        }
        return ($str);
    }

    function watchVertex($worldVertex)
    {
        return $this->origin;
    }

    function __toString()
    {
        $m = $this->tT->get_matrix();
        $str = sprintf("Camera(\n+ Origine: Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )\n+ tT:\n", $this->origin->get_x(), $this->origin->get_y(), $this->origin->get_z(), $this->origin->get_w());
        $str .= $this->print_Matrix($m);
        $str .= "\n+ tR\n";
        $str .= $this->print_Matrix($this->orientation->get_matrix());
        $str .= "\n+ tR->mult( tT ):\n";
        $str .= $this->print_Matrix($this->tR_mult->get_matrix());
        $str .= "\n+ Proj:\n";
        $str .= $this->print_Matrix($this->proj->get_matrix());
        $str .= "\n)";
        return $str;
    }
}