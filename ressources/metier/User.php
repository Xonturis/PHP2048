<?php


class User
{
    private $pseudo;

    /**
     * User constructor.
     * @param $pseudo
     */
    public function __construct($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

}