<?php

use PHPUnit\Framework\TestCase;
use Investment\Loan;
use Investment\Investment;
use Investment\Tranch;

class LoanTest extends TestCase
{
    public function setUp(){
    }

    public function testReport(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $loan->tranch(new Tranch('A', 0.03, 1000));
        $loan->tranch(new Tranch('B', 0.06, 1000));
        $loan->invest(new Investment('Investor 1', 1000, 'A', new DateTime('2015-10-03')));
        $loan->invest(new Investment('Investor 3', 500,  'B', new DateTime('2015-10-10')));
        $this->assertEquals(
            "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds",
            $loan->report(new DateTime('2015-10-31')));
    }
    public function testOverinvestA(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $loan->tranch(new Tranch('A', 0.03, 1000));
        $loan->tranch(new Tranch('B', 0.06, 1000));
        $loan->invest(new Investment('Investor 1', 1000, 'A', new DateTime('2015-10-03')));
        $this->expectException(\Exception::class);
        $loan->invest(new Investment('Investor 2', 1,    'A', new DateTime('2015-10-04')));
    }
    public function testOverinvestB(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $loan->tranch(new Tranch('A', 0.03, 1000));
        $loan->tranch(new Tranch('B', 0.06, 1000));
        $loan->invest(new Investment('Investor 1', 1000, 'A', new DateTime('2015-10-03')));
        $loan->invest(new Investment('Investor 3', 500,  'B', new DateTime('2015-10-10')));
        $this->expectException(\Exception::class);
        $loan->invest(new Investment('Investor 4', 1100, 'B', new DateTime('2015-10-25')));
    }
    public function testReportForDateTooEarly(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->report(new DateTime('2015-09-30'));
    }
    public function testReportForDateToolate(){
        $loan = new Loan(new DateTime('2015-10-01'), new DateTime('2015-11-15'));
        $this->expectException(\Exception::class);
        $loan->report(new DateTime('2015-11-16'));
    }
}
