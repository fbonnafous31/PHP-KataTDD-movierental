<?php
namespace App;

class NewRentalMovie extends Movie {

    public function __construct($title)
    {
        parent::__construct($title);
    }

    public function getAmount(int $daysRented) {
        return $daysRented * 3;
    }

    public function getRenterPoint(int $daysRented=1) {
        $point = 1;
        if ($daysRented > 1) $point++ ;
        return $point;
    }

}