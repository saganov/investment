<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;
use Investment\Tranch;
use Investment\Investor;

class LoanTest extends TestCase
{
    private $loan;
    private $tranchA;
    private $tranchB;
    public function setUp(){
        $this->loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->tranchA = new Tranch('A', 0.03, 1000);
        $this->tranchB = new Tranch('B', 0.06, 1000);
        $this->loan->tranch($this->tranchA)->tranch($this->tranchB);
    }

    public function testReport(){
        $investor1 = new Investor('Investor 1', 1000);
        $investor3 = new Investor('Investor 3', 1000);
        $investor1->invest($this->tranchA, 1000, new DateTime('2015-10-03'));
        $investor3->invest($this->tranchB, 500,  new DateTime('2015-10-10'));
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $this->loan->report(new DateTime('2015-10-31')));
    }
    public function testReportForDateTooEarly(){
        $this->expectException(\Exception::class);
        $this->loan->report(new DateTime('2015-09-30'));
    }
    public function testReportForDateToolate(){
        $this->expectException(\Exception::class);
        $this->loan->report(new DateTime('2015-11-16'));
    }
}
