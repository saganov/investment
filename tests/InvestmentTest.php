<?php

use PHPUnit\Framework\TestCase;
use Investment\Investment;

class InvestmenTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculateOne(){
        $investment = new Investment('Investor 1', 1000, 0.03, new DateTime('2015-10-03'));
        $this->assertEquals(28.06, $investment->calculateInterest(new DateTime('2015-10-31')),
            'Invalid interest calculation', 0.005);
    }
    public function testInterestCalculateTwo(){
        $investment = new Investment('Investor 3', 500,  0.06, new DateTime('2015-10-10'));
        $this->assertEquals(21.29, $investment->calculateInterest(new DateTime('2015-10-31')),
            'Invalid interest calculation', 0.005);
    }
}