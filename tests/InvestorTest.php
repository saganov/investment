<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;
use Investment\Investment;
use Investment\Tranch;
use Investment\Investor;

class InvestorTest extends TestCase
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
    public function testInvestTooMuch(){
        $investor = new Investor('Investor', 1000);
        $this->expectException(\Exception::class);
        $investor->invest($this->tranchA, 1001, new DateTime('2015-10-04'));
    }
}
