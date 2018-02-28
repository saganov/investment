<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;

class LoanTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $loan->invest(['investor' => 'Investor 1', 'sum' => 1000, 'interest' => 0.03, 'date' => new DateTime('2015-10-03')]);
        $loan->invest(['investor' => 'Investor 3', 'sum' => 500, 'interest' => 0.06, 'date' => new DateTime('2015-10-10')]);
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $loan->calculateInterest(new DateTime('2015-10-31')));
    }
    public function testInterestCalculateWithInvalidDate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->calculateInterest(new DateTime('2015-09-30'));
        $loan->calculateInterest(new DateTime('2015-11-16'));
    }
}
