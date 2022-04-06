<?php
namespace App;

class RegularMovie extends Movie {

    public function __construct($title)
    {
        parent::__construct($title);
    }

    public function getAmount(int $daysRented) {
        if ($daysRented > 2) {
            return 2 + ($daysRented - 2) * 1.5;
        }
        return 2;
    }

    public function getRenterPoint(int $daysRented) {
        return 1;
    }

}