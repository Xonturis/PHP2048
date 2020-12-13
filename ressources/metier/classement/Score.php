<?php


class Score
{
    public $name;
    public $score;
    public $gagne;

    function __construct($name, $score,$gagne)
    {
        $this->name = $name;
        $this->score = $score;
        $this->gagne = $gagne;
    }

    public static function compareTo(Score $score1, Score $score2): int
    {
        return $score1->score - $score2->score;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    public function getGagne(){
        return $this->gagne;
    }
}