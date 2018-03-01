<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;
use Investment\Investment;
use Investment\Tranch;
use Investment\Investor;

class TranchTest extends TestCase
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

    public function testOverinvestA(){
        $investor1 = new Investor('Investor 1', 1000);
        $investor2 = new Investor('Investor 2', 1000);
        $investor1->invest($this->tranchA, 1000, new DateTime('2015-10-03'));
        $this->expectException(\Exception::class);
        $investor2->invest($this->tranchA, 1, new DateTime('2015-10-04'));
    }
    public function testOverinvestB(){
        $investor3 = new Investor('Investor 3', 1000);
        $investor4 = new Investor('Investor 4', 1000);
        $investor3->invest($this->tranchB, 500, new DateTime('2015-10-10'));
        $this->expectException(\Exception::class);
        $investor4->invest($this->tranchB, 1100, new DateTime('2015-10-25'));
    }
    public function testConnectTranchTwice(){
        $otherLoan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $otherLoan->tranch($this->tranchA);
    }
    public function testInvestForDateTooEarly(){
        $investor = new Investor('Investor', 1000);
        $this->expectException(\Exception::class);
        $investor->invest($this->tranchA, 1000, new DateTime('2015-09-30'));
    }
    public function testInvestForDateToolate(){
        $investor = new Investor('Investor', 1000);
        $this->expectException(\Exception::class);
        $investor->invest($this->tranchA, 1000, new DateTime('2015-11-16'));
        $this->expectException(\Exception::class);
    }
}
