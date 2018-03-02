<?php

use PHPUnit\Framework\TestCase;
use Investment\Investment;
use Investment\Investor;

class InvestmenTest extends TestCase
{
    public function setUp(){
    }

    public function testInterestCalculateOne(){
        $investment = new Investment(new Investor('Investor 1', 1000), 1000, new DateTime('2015-10-03'), 0.03);
        $this->assertEquals(28.06, $investment->report(new DateTime('2015-10-31'))['Investor 1'],
            'Invalid interest calculation', 0.005);
    }
    public function testInterestCalculateTwo(){
        $investment = new Investment(new Investor('Investor 3', 1000), 500, new DateTime('2015-10-10'), 0.06);
        $this->assertEquals(21.29, $investment->report(new DateTime('2015-10-31'))['Investor 3'],
            'Invalid interest calculation', 0.005);
    }
}
