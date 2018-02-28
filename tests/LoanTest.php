<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;

class LoanTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculate(){
        $loan = new Loan();
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $loan->calculateInterest('31/10/2015'));
    }
}
