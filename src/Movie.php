<?php
namespace App;

abstract class Movie
{

    public function __construct($title)
    {
        $this->_title = $title;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    abstract public function getAmount(int $daysRented);
    abstract public function getRenterPoint(int $daysRented);
}
