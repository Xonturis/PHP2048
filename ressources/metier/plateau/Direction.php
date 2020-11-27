<?php


class Direction
{

    private $direction;
    private $dirX;
    private $dirY;

    public function __construct($direction) {
        $this->direction = $direction;
        $this->setDirections();
    }

    private function setDirections() {
        $this->dirX = 0;
        $this->dirY = 0;
        switch ($this->direction) {
            case 0: // haut
                $this->dirX = -1;
                break;
            case 1: // bas
                $this->dirX = 1;
                break;
            case 2: // gauche
                $this->dirY = -1;
                break;
            case 3: // droite
                $this->dirY = 1;
                break;
        }
    }

    /**
     * @return mixed
     */
    public function getDirX()
    {
        return $this->dirX;
    }

    /**
     * @return mixed
     */
    public function getDirY()
    {
        return $this->dirY;
    }



}