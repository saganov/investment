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
        $this->tranchA->invest(new Investment(new Investor('Investor 1', 1000), 1000, new DateTime('2015-10-03')));
        $this->expectException(\Exception::class);
        $this->tranchA->invest(new Investment(new Investor('Investor 2', 1000), 1,    new DateTime('2015-10-04')));
    }
    public function testOverinvestB(){
        $this->tranchB->invest(new Investment(new Investor('Investor 3', 1000), 500,  new DateTime('2015-10-10')));
        $this->expectException(\Exception::class);
        $this->tranchB->invest(new Investment(new Investor('Investor 4', 1000), 1100, new DateTime('2015-10-25')));
    }
    public function testConnectTranchTwice(){
        $otherLoan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $otherLoan->tranch($this->tranchA);
    }
    public function testInvestTwice(){
        $investment = new Investment(new Investor('Investor 2', 1000), 1, new DateTime('2015-10-04'));
        $this->tranchA->invest($investment);
        $this->expectException(\Exception::class);
        $this->tranchB->invest($investment);
    }
    public function testInvestForDateTooEarly(){
        $this->expectException(\Exception::class);
        $this->tranchA->invest(new Investment(new Investor('Investor 1', 1000), 1000, new DateTime('2015-09-30')));
    }
    public function testInvestForDateToolate(){
        $this->expectException(\Exception::class);
        $this->tranchA->invest(new Investment(new Investor('Investor 1', 1000), 1000, new DateTime('2015-11-16')));
    }
}
