<?php
require_once "Direction.php";
require_once "Position.php";

class Plateau
{

    private $rewindCount;
    private $size;
    private $tuiles;
    private $score;

    /**
     * Plateau constructor.
     * @param int $size la taille du plateau de jeu (carré) (défaut : 4x4)
     */
    public function __construct($size = 4)
    {
        $this->rewindCount = 0;
        $this->score = 0;
        $tuiles = array();

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

    /**
     * Trouve l'ordre des tuiles à parcourir pour éviter d'avoir à faire 4 méthodes ou un switch
     *
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
     *
     * @param Direction $direction dans quelle direction
     * @return array[] l'ordre
     */
    public function getRightOrder(Direction $direction): array
    {
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

    /**
     *
     * @param int $x
     * @param int $y
     * @return Tuile|null
     */
    public function getTuile(int $x, int $y) :?Tuile {
        if($x < 0 || $x >= $this->size || $y < 0 || $y >= $this->size) {
            return null;
        }
        return $this->tuiles[$x][$y];
    }

    /**
     * Effectue un mouvement
     * @param int $direction la direction
     * @return bool
     */
    public function move(int $direction): bool
    {
        $moved = false;
        $direction = new Direction($direction);
        $orders = $this->getRightOrder($direction);
        $orderX = $orders["x"];
        $orderY = $orders["y"];

        foreach ($orderX as $x) {
            foreach ($orderY as $y) {
                $currentTuile = $this->getTuile($x, $y);
                if($currentTuile->getScore() == 0) {
                    continue;
                }
                $position = new Position($x, $y, $this, $direction);
                $position->lePlusLoinPossible();
                $candidateTuile = $position->prochaineTuile();
                $plusLoinTuile = $position->getTuile();

                $moved = $this->tryMove($candidateTuile, $currentTuile, $plusLoinTuile) || $moved;
            }
        }

        return $moved;
    }

    /**
     * @param Tuile|null $candidateTuile
     * @param Tuile|null $currentTuile
     * @param Tuile|null $plusLoinTuile
     * @return bool
     */
    private function tryMove(?Tuile $candidateTuile, ?Tuile $currentTuile, ?Tuile $plusLoinTuile): bool
    {
        $moved = false;
        if ($candidateTuile == null) {
            if ($this->moveTuileTo($currentTuile, $plusLoinTuile)) {
                $moved = true;
            }
        } else {
            if ($candidateTuile->merged()) {
                if ($this->moveTuileTo($currentTuile, $plusLoinTuile)) {
                    $moved = true;
                }
            } else {
                $mergeScore = $candidateTuile->getScore() * 2;
                if ($candidateTuile->mergeWith($currentTuile)) {
                    $moved = true;
                    $this->score += $mergeScore;
                } else if ($this->moveTuileTo($currentTuile, $plusLoinTuile)) {
                    $moved = true;
                }
            }
        }
        return $moved;
    }

    /**
     * Déplace from vers to en effectuant le test pour éviter de déplacer une tuile vers elle même
     * @param Tuile $from depuis quelle tuile
     * @param Tuile $to vers quelle tuile
     * @return bool true si on déplace false sinon
     */
    private function moveTuileTo(Tuile $from, Tuile $to) : bool{
        return $to->replaceWith($from);
    }

    /**
     * @return array des tuiles ayant comme score = 0
     */
    private function tuilesZero() : array
    {
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

    /**
     * @return bool true si la game est perdu false sinon
     */
    public function perdu() : bool {
        if(count($this->tuilesZero()) == 0) {
            for ($x = 0; $x < $this->size; $x++) {
                for ($y = 0; $y < $this->size; $y++) {
                    if($this->canMerge($x, $y)){
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }

    private function canMerge(int $x, int $y) : bool {
        $val = $this->getTuile($x, $y)->getScore();
        $valRight = $this->getTuile($x, $y + 1);
        if ($valRight != null && $valRight->getScore() == $val) {
            return true;
        }
        $valDown = $this->getTuile($x + 1, $y);
        if ($valDown != null && $valDown->getScore() == $val) {
            return true;
        }
        return false;
    }

    /**
     * Enlève le flag qui indique que la tuile a été "mergé" sur toutes les tuiles
     */
    public function unflagMergeTuiles() {
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $tuile->unflagMerge();
            }
        }
    }

    /**
     * Place une tuile au hasard dans le plateau
     */
    public function aleatTuile() {
        $zeroScore = $this->tuilesZero();
        $count = count($zeroScore);

        if($count == 0) {
            return;
        }

        try {
            $randScore = rand(1,100)<=10?4:2;
            $zeroScore[random_int(0, $count - 1)]->setScore($randScore);
        } catch (Exception $e) {
            $this->aleatTuile();
        }
    }

    /**
     * Reset le plateau
     */
    public function reset() {
        $i = 1;
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $tuile->setScore(0);
                $tuile->unflagMerge();
                $i ++;
            }
        }

        $this->rewindCount = 0;
        $this->score = 0;
        $this->aleatTuile();
        $this->aleatTuile();
    }

    /**
     * @return int somme des tuiles
     */
    public function getScore(): int
    {
        return $this->score - 5*$this->rewindCount;
    }

    /**
     * @return int le score le plus élevé parmi toutes les tuiles
     */
    public function getMaxTuile(): int
    {
        $max = 0;
        foreach ($this->tuiles as $ligne) {
            foreach ($ligne as $tuile) {
                $tuileScore = $tuile->getScore();
                if($tuileScore > $max) {
                    $max = $tuileScore;
                }
            }
        }
        return $max;
    }

    /**
     * Génère la grille représentant l'état de la partie
     * @return array représentant l'état de la partie
     */
    public function getIntegerGrid(): array
    {
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

    /**
     * Incrémente le compteur des "mouvement précédent"
     * @see Plateau::getRewindCount()
     * @param $rewindCount int le compteur de l'objet précédent (du mouvement actuel)
     */
    public function incrementRewindCount(int $rewindCount)
    {
        $this->rewindCount = $rewindCount + 1;
    }

    /**
     * @return int le compteur représentant le nombre de fois que le joueur est revenu sur son mouvement précédent
     */
    public function getRewindCount(): int
    {
        return $this->rewindCount;
    }

}