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
            $thisAmount = $each->getMovie()->getAmount($each->getDaysRented());
            $frequentRenterPoints += $each->getMovie()->getRenterPoint($each->getDaysRented());

            $result .= sprintf("\t%s\t%1.1f\n", $each->getMovie()->getTitle(), $thisAmount);
            $totalAmount += $thisAmount;
        }

        $result .= sprintf("Amount owed is %1.1f\n", $totalAmount);
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";

        return $result;

    }

    private function getName()
    {
        return $this->_name;
    }
}
