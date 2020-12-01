<?php
require_once "Ligne.php";
require_once "Direction.php";
require_once "Position.php";

class Plateau
{
    private $size;
    private $tuiles;

    /**
     * Plateau constructor.
     * @param int $size la taille du plateau de jeu (carré) (défaut : 4x4)
     */
    public function __construct($size = 4)
    {
        $tuiles = array();
        $this->lignes = array();

        for ($x = 0; $x < $size; $x++){
            $line = array();
            for ($y = 0; $y < $size; $y++){
                $newTuile = new Tuile();
                array_push($line, $newTuile);
            }
            array_push($tuiles, $line);
        }

        $this->tuiles = $tuiles;
        $this->size = $size;

        $this->aleatTuile();
        $this->aleatTuile();
        $this->unflagMergeTuiles();
    }


    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    //todo                          TO BE OPTIMIZED
    public function getRightOrder(Direction $direction) {
        /*
         * Pour éviter d'avoir un switch ou 4 méthodes comme avant,
         * on essaye de parcourir de façon logique par rapport au
         * mouvement voulu par le joueur :
         *      Essayer de partir de là où on va en gros
         *
         * Exemple avec le mouvement HAUT (sur deux colonnes) :
         * On va essayer les deux façons traitement bas vers haut
         * et haut vers bas :
         * BH = traitement de Bas en Haut
         * HB = traitement de Haut en Bas
         *  * ORDRE *             * DÉPART *           * ARRIVÉE *
         *    BH  HB                BH  HB               BH  HB
         *  *---*---*             *---*---*            *---*---*
         *  | 4 | 1 |             | 2 | 2 |            | 4 | 4 |
         *  *---*---*             *---*---*            *---*---*
         *  | 3 | 2 |             | 2 | 2 |            | 0 | 4 |
         *  *---*---*    ---->    *---*---*    ---->   *---*---*
         *  | 2 | 3 |             | 2 | 2 |            | 4 | 0 |
         *  *---*---*             *---*---*            *---*---*
         *  | 1 | 4 |             | 2 | 2 |            | 0 | 0 |
         *  *---*---*             *---*---*            *---*---*
         *                                              KO   OK
         */

        $orderX = array();
        $orderY = array();

        $reverseX = $direction->getDirX() == 1;
        $reverseY = $direction->getDirY() == 1;

        for ($index = 0; $index < $this->size; $index++) {
            array_push($orderX, $reverseX ? 3-$index : $index);
            array_push($orderY, $reverseY ? 3-$index : $index);
        }

        return array("x" => $orderX, "y" => $orderY);
    }

    public function getTuile(int $x, int $y) :?Tuile {
        if($x < 0 || $x >= $this->size || $y < 0 || $y >= $this->size)
            return null;
        return $this->tuiles[$x][$y];
    }

    public function move(int $direction) {
        $direction = new Direction($direction);
        $orders = $this->getRightOrder($direction);
        $orderX = $orders["x"];
        $orderY = $orders["y"];

        foreach ($orderX as $x) {
            foreach ($orderY as $y) {
                $currentTuile = $this->getTuile($x, $y);
                if($currentTuile->getScore() == 0) continue;
                $position = new Position($x, $y, $this, $direction);
                $position->lePlusLoinPossible();
                $candidateTuile = $position->prochaineTuile();
                $plusLoinTuile = $position->getTuile();

                if($candidateTuile == null) {
                    $this->moveTuileTo($currentTuile, $plusLoinTuile);
                } else {
                    if($candidateTuile->merged()) {
                        $this->moveTuileTo($currentTuile, $plusLoinTuile);
                    } else if(!$candidateTuile->mergeWith($currentTuile)) {
                        $this->moveTuileTo($currentTuile, $plusLoinTuile);
                    }
                }
            }
        }

    }

    private function moveTuileTo(Tuile $from, Tuile $to) {
        if($from !== $to)
            $to->replaceWith($from);
    }
    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    private function tuilesZero() : array {
        $zeroScore = array();
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                if ($tuile->getScore() == 0) {
                    array_push($zeroScore, $tuile);
                }
            }
        }
        return $zeroScore;
    }

    private function nbDeTuileZero() :int{
        $zeroScore = $this->tuilesZero();
        return count($zeroScore);
    }

    public function perdu() : bool {
        $count = $this->nbDeTuileZero();

        if($count == 0) {
            return true;
        }
        return false;
    }

    public function unflagMergeTuiles() {
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
//                if ($tuile->getScore() == 0) {
                    $tuile->unflagMerge();
//                }
            }
        }
    }

    public function aleatTuile() {
        $zeroScore = $this->tuilesZero();
        $count = count($zeroScore);

        if($count == 0) {
            return;
        }

        try {
            $zeroScore[random_int(0, $count - 1)]->setScore(2);
        } catch (Exception $e) {
            $this->aleatTuile();
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
        return $score;
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
        return $max;
    }

    public function getIntegerGrid() {
        $grid = array();

        foreach($this->tuiles as $ligne) {
            $ligneInt = array();
            foreach($ligne as $tuile) {
                array_push($ligneInt, $tuile->getScore());
            }
            array_push($grid, $ligneInt);
        }

        return $grid;
    }

}