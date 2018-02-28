<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;

class LoanTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $loan->calculateInterest(new DateTime('2015-11-01')));
    }
    public function testInterestCalculateWithInvalidDate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->calculateInterest(new DateTime('2015-09-30'));
        $loan->calculateInterest(new DateTime('2015-11-16'));
    }
}
