<?php


class Score
{
    public $name;
    public $score;
    public $gagne;

    /**
     * Score constructor.
     * @param $name String nom du joueur
     * @param $score integer score du joueur
     * @param $gagne integer si le joueur gagne ou perd.
     */
    function __construct($name, $score,$gagne)
    {
        $this->name = $name;
        $this->score = $score;
        $this->gagne = $gagne;
    }

    /**
     * Renvoie le nom du joueur
     * @return String le nom
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Renvoie le score du joueur
     * @return integer le score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Renvoie si le joueur gagne ou perd.
     * @return int
     */
    public function getGagne(){
        return $this->gagne;
    }
}