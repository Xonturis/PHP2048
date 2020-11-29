<?php


class Classement
{
    private $tabScore;

    function __construct()
    {
        $this->tabScore = array();
    }

    public function addScore(Score $score)
    {
        array_push($this->tabScore, $score);
        usort($this->tabScore,"Score::compareTo");
    }

    public function removeScore(Score $score)
    {
        array_search($score,$this->tabScore);
        array_splice($tabScore, 1, 1);
    }

    public function getTab() : array{
        return $this->tabScore;
    }

}