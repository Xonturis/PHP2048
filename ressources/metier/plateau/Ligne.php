<?php


class Ligne
{
    private $tuiles;

    /**
     * Ligne constructor.
     * @param $tuiles
     */
    public function __construct(array $tuiles)
    {
        $this->tuiles = $tuiles;
    }

    public function getTuiles() {
        return $this->tuiles;
    }

}