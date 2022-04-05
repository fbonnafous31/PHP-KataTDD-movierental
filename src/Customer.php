<?php
namespace App;

class Customer
{

    private array $_rentals;

    public function __construct($string)
    {
        $this->_name = $string;
    }

    public function addRental($param)
    {
        $this->_rentals[] = $param;
    }

    public function statement()
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->_rentals as $each) {
            $thisAmount = 0;
            $movie      = $each->getMovie()->getPriceCode(); 
            $dayRented  = $each->getDaysRented();

            //determine amounts for each line
            if ( $movie == Movie::REGULAR) {
                $thisAmount += 2;
                $thisAmount += ($dayRented - 2) * 1.5;
            } elseif ($movie == Movie::NEW_RELEASE) {
                $thisAmount += $dayRented * 3;
                if ($dayRented > 1) $frequentRenterPoints++;
            }  elseif ($movie == Movie::CHILDRENS) {
                $thisAmount = $each->getMovie()->getAmount($dayRented);
            }
            
            // add frequent renter points
            $frequentRenterPoints++;

            // show figures for this rental
            $result .= sprintf("\t%s\t%1.1f\n", $each->getMovie()->getTitle(), $thisAmount);
            $totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= sprintf("Amount owed is %1.1f\n", $totalAmount);
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";

        return $result;

    }

    private function getName()
    {
        return $this->_name;
    }
}
