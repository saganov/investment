<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;
use Investment\Investment;

class LoanTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $loan->tranch(['name' => 'A', 'rate' => 0.03, 'amount' => 1000]);
        $loan->tranch(['name' => 'B', 'rate' => 0.06, 'amount' => 1000]);
        $loan->invest(new Investment('Investor 1', 1000, 'A', new DateTime('2015-10-03')));
        $loan->invest(new Investment('Investor 3', 500,  'B', new DateTime('2015-10-10')));
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $loan->report(new DateTime('2015-10-31')));
    }
    public function testInterestCalculateForDateTooEarly(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->report(new DateTime('2015-09-30'));
    }
    public function testInterestCalculateForDateToolate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->report(new DateTime('2015-11-16'));
    }
}
