<?php
namespace App;

class Movie
{

    public function __construct($title)
    {
        $this->_title = $title;
    }

    public function getTitle()
    {
        return $this->_title;
    }

}
