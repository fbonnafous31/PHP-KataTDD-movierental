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
        $renterPoint = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->_rentals as $each) {
            $amount       = $each->getMovie()->getAmount($each->getDaysRented());
            $renterPoint += $each->getMovie()->getRenterPoint($each->getDaysRented());
            $result      .= sprintf("\t%s\t%1.1f\n", $each->getMovie()->getTitle(), $amount);
            $totalAmount += $amount;
        }

        $result .= sprintf("Amount owed is %1.1f\n", $totalAmount);
        $result .= "You earned " . $renterPoint . " frequent renter points";

        return $result;

    }

    private function getName()
    {
        return $this->_name;
    }
}
