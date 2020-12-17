<?php


/**
 * Class Tuile
 * La classe qui représente les "tuiles" du jeu (toutes les tuiles même 0)
 */
class Tuile
{

    private $score = 0;
    private $merged = false;

    /**
     * @return int
     */
    public function getScore() :int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score) :void
    {
        $this->score = $score;
    }

    public function replaceWith(Tuile $tuile) :bool {
        if($tuile !== $this && ($this->getScore()==$tuile->getScore() || $this->getScore()==0)) {
            $this->setScore($this->getScore()+$tuile->getScore());
            $tuile->setScore(0);
            return true;
        }
        return false;
    }

    /**
     * Tente un mix entre cette tuile et une autre (valeurs doivent être égale ou 0)
     * @param Tuile $tuile la tuile qu'on veut mixer
     * @return bool true si le mixage a pu être effectué, false sinon
     */
    public function mergeWith(Tuile $tuile) :bool {
        if($this->replaceWith($tuile)) {
            $this->merged = true;
            return true;
        }
        return false;
    }

    /**
     * Marque la tuile comme non mixée
     * N.B. : Un seul mixage autorisé par tuile à chaque mouvement
     */
    public function unflagMerge() {
        $this->merged = false;
    }

    /**
     * @return bool true si la tuile a été mixée, false sinon
     */
    public function merged() :bool {
        return $this->merged;
    }
}