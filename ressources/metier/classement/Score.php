<?php


class Score
{
    public $naùe;
    public $score;

    public function __cunstruct($name, $score)
    {
        $this->name = $name;
        $this->score = $score;
    }

    public static function compareTo(Score $score1, Score $score2): int
    {
        return $score1->score - $score2->score;
    }
}