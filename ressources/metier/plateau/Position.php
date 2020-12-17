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

    /**
     * Methode recursive pour retrouver la tuile la plus lointaine qui est égale à 0 dans une direction
     * @see Direction
     */
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

    /**
     * @return Tuile|null la prochaine tuile (celle qui vient après la tuile la plus lointaine)
     * @see Tuile
     * @see Position::lePlusLoinPossible
     */
    public function prochaineTuile() :?Tuile {
        return $this->plateau->getTuile(
            $this->x + $this->direction->getDirX(),
            $this->y + $this->direction->getDirY()
        );
    }

    /**
     * @return Tuile|null la tuile la plus lointaine
     * @see Tuile
     * @see Position::lePlusLoinPossible
     */
    public function getTuile() :?Tuile {
        return $this->plateau->getTuile($this->x,$this->y);
    }


}