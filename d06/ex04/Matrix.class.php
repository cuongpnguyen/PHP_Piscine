<?php
require_once('Vector.class.php');
require_once('Vertex.class.php');
require_once('Color.class.php');

class Matrix
{
    private $preset;
    private $scale;
    private $angle;
    private $fov;
    private $ratio;
    private $near;
    private $far;
    private $vtc;
    private $matrix;
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
        $this->construct_matrix();
    }

    function assign_var($array)
    {
        if (array_key_exists('preset', $array))
            $this->preset = $array['preset'];
        if (array_key_exists('scale', $array))
            $this->scale = $array['scale'];
        if (array_key_exists('angle', $array))
            $this->angle = $array['angle'];
        if (array_key_exists('vtc', $array))
            $this->vtc = $array['vtc'];
        if (array_key_exists('fov', $array))
            $this->fov = $array['fov'];
        if (array_key_exists('ratio', $array))
            $this->ratio = $array['ratio'];
        if (array_key_exists('near', $array))
            $this->near = $array['near'];
        if (array_key_exists('far', $array))
            $this->far = $array['far'];
    }
    function __toString()
    {
        $str = "M | vtcX | vtcY | vtcZ | vtxO\n";
        $str .= "-----------------------------\n";
        $str .= "x";
        for ($x = 0; $x < 4; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$this->matrix[$x]);
            if ($x == 3)
                $str .= "\n";
        }
        $str .= "y";
        for ($x = 4; $x < 8; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$this->matrix[$x]);
            if ($x == 7)
                $str .= "\n";
        }
        $str .= "z";
        for ($x = 8; $x < 12; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$this->matrix[$x]);
            if ($x == 11)
                $str .= "\n";
        }
        $str .= "w";
        for ($x = 12; $x < 16; $x++)
        {
            $str .= " | ";
            $str .= sprintf("%.2f",$this->matrix[$x]);
            if ($x == 15)
                $str .= "\n";
        }
        return ($str);
    }
    function doc()
    {
        $str = file_get_contents('Matrix.doc.txt');
        if ($str)
            echo $str;
        else
            print("Error : Matrix.doc.txt doesn't exist\n");
        return ;
    }

    function get_matrix()
    {
        return ($this->matrix);
    }
    function valid()
    {
        if ($preset == "SCALE" && $scale == NULL)
        {
            return "Error. Scale but no preset scale\n";
            exit();
        }
    }
    function mult( Matrix $rhs )
    {
        $result;
        for ($i=0;$i<4;$i++){
            for ($j=0;$j<4;$j++){
              $result[$i*4+$j]=0;
              for ($k=0;$k<4;$k++){
                    $result[$i*4+$j]+= $this->matrix[$i*4+$k]*$rhs->matrix[$k*4+$j];
                }
            }
         }
         $mat = new Matrix(array('preset' => Matrix::IDENTITY));
         $mat->matrix = $result;
         return $mat;
    }

    function transformVertex($vtx)
    {
        $new = clone $vtx;
        $tmp = 0;
        for($i = 0; $i < 4; $i++)
        {
            $tmp += $new->get_x() * $this->matrix[$i];
        }
        $new->set_x($tmp);
        $tmp = 0;
        for($i = 4; $i < 8; $i++)
        {
            $tmp += $new->get_y() * $this->matrix[$i];
        }
        $new->set_y($tmp);
        $tmp = 0;
        for($i = 8; $i < 12; $i++)
        {
            $tmp += $new->get_z() * $this->matrix[$i];
        }
        $new->set_z($tmp);
        return ($new);
    }
    
    function construct_matrix()
    {
        $matrix = array_fill(0, 16, 0);
        $matrix[0] = 1;
        $matrix[5] = 1;
        $matrix[10] = 1;
        $matrix[15] = 1;
        if ($this->preset == self::SCALE)
        {
            $matrix[0] *= $this->scale;
            $matrix[5] *= $this->scale;
            $matrix[10] *= $this->scale;
        }
        if ($this->preset == self::TRANSLATION)
        {
            $matrix[3] = $this->vtc->get_x();
            $matrix[7] = $this->vtc->get_y();
            $matrix[11] = $this->vtc->get_z();
        }
        if ($this->preset == self::RX)
        {
            $matrix[5] = cos($this->angle);
            $matrix[6] = -sin($this->angle);
            $matrix[9] = sin($this->angle);
            $matrix[10] = cos($this->angle);
        }
        if ($this->preset == self::RY)
        {
            $matrix[0] = cos($this->angle);
            $matrix[2] = sin($this->angle);
            $matrix[8] = -sin($this->angle);
            $matrix[10] = cos($this->angle);
        }
        if ($this->preset == self::RZ)
        {
            $matrix[0] = cos($this->angle);
            $matrix[1] = -sin($this->angle);
            $matrix[4] = sin($this->angle);
            $matrix[5] = cos($this->angle);
        }
        if ($this->preset == self::PROJECTION)
        {
            $y = 1/(tan(deg2rad($this->fov)/2));
            $x = $y/$this->ratio;
            $c = ($this->far + $this->near) / ($this->near - $this->far);
            $d = (2 * $this->far * $this->near) / ($this->near - $this->far);
            $matrix[0] = $x;
            $matrix[5] = $y;
            $matrix[10] = $c;
            $matrix[11] = $d;
            $matrix[14] = -1;
            $matrix[15] = 0;
        }
        $this->matrix = $matrix;
    }
}
