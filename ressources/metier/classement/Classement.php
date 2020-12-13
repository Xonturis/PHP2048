<?php


class Classement
{
    private $tabScore;

    /**
     * Classement constructor.
     */
    function __construct()
    {
        $this->tabScore = array();
    }

    /**
     * Ajoute un score au classement.
     * @param Score $score le score à ajouter
     */
    public function addScore(Score $score)
    {
        array_push($this->tabScore, $score);
    }


    /**
     * renvoie le classement sous forme de tableau.
     * @return array le tableau
     */
    public function getTab() : array{
        return $this->tabScore;
    }

}