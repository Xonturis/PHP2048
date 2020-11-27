<?php
require_once "Plateau.php";

class Position
{

    private $x,$y;
    private $plateau;
    private $direction;

    /**
     * Position constructor.
     * @param $x int
     * @param $y int
     * @param $plateau Plateau
     * @param Direction $direction
     */
    public function __construct(int $x, int $y, Plateau $plateau, Direction $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->plateau = $plateau;
        $this->direction = $direction;
    }

    public function lePlusLoinPossible() {
        $prochainX = $this->x + $this->direction->getDirX();
        $prochainY = $this->y + $this->direction->getDirY();

        $tuile = $this->prochaineTuile();
        if($tuile != null && $tuile->getScore() == 0) {
            $this->x = $prochainX;
            $this->y = $prochainY;
            $this->lePlusLoinPossible();
        }
    }

    public function prochaineTuile() :?Tuile {
        return $this->plateau->getTuile(
            $this->x + $this->direction->getDirX(),
            $this->y + $this->direction->getDirY()
        );
    }

    public function getTuile() :?Tuile {
        return $this->plateau->getTuile($this->x,$this->y);
    }


}