<?php
require_once "Ligne.php";

class Plateau
{
    private $size;
    private $lignes; // only for vues
    private $tuiles;

    /**
     * Plateau constructor.
     * @param int $size la taille du plateau de jeu (carré) (défaut : 4x4)
     */
    public function __construct($size = 4)
    {
        $tuiles = array();
        $this->lignes = array();
        $creatingArray = array();
        for ($tuileNo = 0; $tuileNo <= $size*$size; $tuileNo++) {
            if($tuileNo % $size == 0 && $tuileNo > 0) {
                array_push($tuiles, $creatingArray);
                array_push($this->lignes, new Ligne($creatingArray));
                $creatingArray = array();
            }
            array_push($creatingArray, new Tuile());
        }
        $this->tuiles = $tuiles;
        $this->size = $size;

        $this->aleatTuile();
        $this->aleatTuile();
    }


    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    //todo                          TO BE OPTIMIZED
    public function haut() {
        for($line = 1; $line < $this->size; $line++){
            for($column = 0; $column < $this->size; $column++) {
                $current = $line;
                $above = $current-1;
                while ($current > 0 && $this->tuiles[$current][$column]->moveTo($this->tuiles[$above][$column])){
                    $current = $above;
                    $above = $current-1;
                }
            }
        }
    }

    public function bas() {
        for($line = $this->size-1; $line >= 0; $line--){
            for($column = 0; $column < $this->size; $column++) {
                $current = $line;
                $under = $current+1;
                while ($current < $this->size-1 && $this->tuiles[$current][$column]->moveTo($this->tuiles[$under][$column])){
                    $current = $under;
                    $under = $current+1;
                }
            }
        }
    }

    public function gauche() {
        for($line = 0; $line < $this->size; $line++){
            for($column = 1; $column < $this->size; $column++) {
                $current = $column;
                $left = $current-1;
                while ($current > 0 && $this->tuiles[$line][$current]->moveTo($this->tuiles[$line][$left])){
                    $current = $left;
                    $left = $current-1;
                }
            }
        }
    }

    public function droite() {
        for($line = 0; $line < $this->size; $line++){
            for($column = $this->size-1; $column >= 0; $column--) {
                $current = $column;
                $left = $current+1;
                while ($current < $this->size-1 && $this->tuiles[$line][$current]->moveTo($this->tuiles[$line][$left])){
                    $current = $left;
                    $left = $current+1;
                }
            }
        }
    }
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    public function aleatTuile() {
        $zeroScore = array();
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                if ($tuile->getScore() == 0) {
                    array_push($zeroScore, $tuile);
                }
            }
        }

        $count = count($zeroScore);

        if($count == 0) {
            // todo vue
            echo "perdu";
            return;
        }

        try {
            $zeroScore[random_int(0, $count - 1)]->setScore(2);
        } catch (Exception $e) {
            //todo vue
            echo $e->getMessage();
        }
    }

    public function reset() {
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $tuile->setScore(0);
            }
        }

        $this->aleatTuile();
        $this->aleatTuile();
    }

    public function getScore() {
        $score = 0;
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $score += $tuile->getScore();
            }
        }
    }

    public function getMaxTuile() {
        $max = 0;
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $score = $tuile->getScore();
                if($score > $max)
                    $max = $score;
            }
        }
    }

    public function getLignes() {
        return $this->lignes;
    }
}