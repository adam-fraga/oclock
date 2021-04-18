<?php

class DB
{
    private PDO $_link;

    public function __construct()
    {
        $pdo = new PDO('mysql:dbname=alarmes;host=localhost', 'adam', 'adam6559571991!');
        $this->setLink($pdo);
    }

    /**
     * @return PDO
     */
    public function getLink(): PDO
    {
        return $this->_link;
    }

    /**
     * @param PDO $link
     */
    public function setLink(PDO $link): void
    {
        $this->_link = $link;
    }

}