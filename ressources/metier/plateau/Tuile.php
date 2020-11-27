<?php


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
        if($this->getScore()==$tuile->getScore() || $this->getScore()==0) {
            $this->setScore($this->getScore()+$tuile->getScore());
            $tuile->setScore(0);
            return true;
        }
        return false;
    }

    public function mergeWith(Tuile $tuile) :bool {
        if($this->replaceWith($tuile)) {
            $this->merged = true;
            return true;
        }
        return false;
    }

    public function unflagMerge() {
        $this->merged = false;
    }

    public function merged() :bool {
        return $this->merged;
//        return true;
    }
}