<?php


class Classement
{
    private $tabScore;

    public function __cunstruct()
    {
        $this->tabScore = array();
    }

    public function addScore(Score $score)
    {
        array_push($tabScore, $score);
        array_sort($tabScore,Score::compareTo());
    }

    public function removeScore(Score $score)
    {
        array_search($score,$this->tabScore);
        array_splice($tabScore, 1, 1);
    }

}