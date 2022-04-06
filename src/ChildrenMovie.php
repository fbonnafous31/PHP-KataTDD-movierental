<?php
namespace App;

class ChildrenMovie extends Movie {

    public function __construct($title)
    {
        parent::__construct($title);
    }

    public function getAmount(int $daysRented) {
        if ($daysRented > 3) {
            return 1.5 + ($daysRented - 3) * 1.5;
        }
        return 1.5;
    }

    public function getRenterPoint(int $daysRented) {
        return 1;
    }

}