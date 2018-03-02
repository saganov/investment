<?php

/**
 * This file is part of the Investment package.
 *
 * (c) Petr Saganov <saganoff@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Investment;

use \DateTime;

/**
 * Investment class
 */
class Investment implements InvestmentInterface
{
    private $investor;
    private $sum;
    private $date;
    private $rate;

    /**
     * Constructor of Investment object
     *
     * @param Investor $investor an investor of the investment
     * @param Integ    $sum      a sum to invest
     * @param DateTime $date     a date to invest to
     * @param Float    $rate     an investment rate of the investment
     *
     * @return Investment
     */
    public function __construct(InvestorInterface $investor, $sum, DateTime $date, $rate){
        $this->investor = $investor;
        $this->sum = $sum;
        $this->date = $date;
        $this->rate = $rate;
    }

    /**
     * Calculate the interest on the specified date for provided interest rate
     *
     * @param DateTime $date a date to calculate interest to
     * @param Float    $rate an interest rate
     *
     * @return void
     */
    private function calculateInterest(DateTime $date){
        return ($this->sum * $this->rate * ($date->diff($this->date, true)->days + 1) / cal_days_in_month(CAL_GREGORIAN, $date->format('n'), $date->format('Y')));
    }

    public function report(DateTime $date){
        return [(string)$this->investor => $this->calculateInterest($date)];
    }

    /**
     * Getter for investment sum
     *
     * @return Integer an investment sum
     */
    public function sum(){
        return $this->sum;
    }
}
