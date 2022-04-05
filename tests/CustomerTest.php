<?php
namespace App;

use App\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function test()
    {
        $customer = new Customer("Bob");
        $customer->addRental(new Rental(new RegularMovie("Jaws"), 2));
        $customer->addRental(new Rental(new RegularMovie("Golden Eye"), 3));
        $customer->addRental(new Rental(new NewRentalMovie("Short New"), 1));
        $customer->addRental(new Rental(new NewRentalMovie("Long New"), 2));
        $customer->addRental(new Rental(new ChildrenMovie("Bambi"), 3));
        $customer->addRental(new Rental(new ChildrenMovie("Toy Story"), 4));

        $expected = "" .
            "Rental Record for Bob\n" .
            "\tJaws\t2.0\n" .
            "\tGolden Eye\t3.5\n" .
            "\tShort New\t3.0\n" .
            "\tLong New\t6.0\n" .
            "\tBambi\t1.5\n" .
            "\tToy Story\t3.0\n" .
            "Amount owed is 19.0\n" .
            "You earned 7 frequent renter points";

        $this->assertSame($expected, $customer->statement());
    }
}
