<?php
namespace App;

class ChildrenMovie extends Movie {

    public function __construct($title, $priceCode)
    {
        parent::__construct($title, $priceCode);
    }

    public function getAmount(int $daysRented) {
        if ($daysRented > 3) {
            return 1.5 + ($daysRented - 3) * 1.5;
        }
        return 1.5;
    }

}