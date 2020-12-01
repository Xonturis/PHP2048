<?php


class Score
{
    public $name;
    public $score;

    function __construct($name, $score)
    {
        $this->name = $name;
        $this->score = $score;
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
}