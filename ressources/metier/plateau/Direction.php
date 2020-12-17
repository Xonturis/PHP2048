<?php


/**
 * Class Direction
 * Classe intermédiaire qui gère le principe de direction quand on fait un mouvement.
 * Passe d'une valeur humaine à une valeur logique pour le programme.
 */
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
            default:
        }
    }

    /**
     * @return int la valeur d'incrémentation vers l'axe X
     */
    public function getDirX() : int
    {
        return $this->dirX;
    }

    /**
     * @return int la valeur d'incrémentation vers l'axe Y
     */
    public function getDirY() : int
    {
        return $this->dirY;
    }



}