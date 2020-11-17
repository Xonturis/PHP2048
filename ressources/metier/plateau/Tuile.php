<?php


class Tuile
{

    private $score = 0;

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    public function moveTo(Tuile $destination) : bool {
        if($this->getScore()==$destination->getScore() || $destination->getScore()==0) {
            $destination->setScore($this->getScore()+$destination->getScore());
            $this->setScore(0);
            return true;
        }
        return false;
    }
}