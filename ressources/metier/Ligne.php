<?php
require_once "Tuile.php";

class Ligne
{

    private $tuiles;

    /**
     * Ligne constructor.
     * @param array $tuiles
     */
    public function __construct($tuiles=array())
    {
        if(empty($tuiles)) {
                array_push($tuiles, new Tuile(), new Tuile(), new Tuile(), new Tuile());
        }
        $this->tuiles = $tuiles;
    }


    public function getCases() {
        return $this->tuiles;
    }
}