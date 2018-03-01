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
class Investment
{
    private $investor;
    private $sum;
    private $tranch;
    private $date;

    /**
     * Constructor of Investment object
     *
     * @param Investor $investor an investor of the investment
     * @param Integ    $sum      a sum to invest
     * @param String   $tranch   a tranch name
     * @param DateTime $date     a date to invest to
     *
     * @return Investment
     */
    public function __construct(Investor $investor, $sum, DateTime $date){
        $this->investor = $investor;
        $this->sum = $sum;
        $this->date = $date;
    }

    /**
     * Calculate the interest on the specified date for provided interest rate
     *
     * @param DateTime $date a date to calculate interest to
     * @param Float    $rate an interest rate
     *
     * @return void
     */
    public function calculateInterest(DateTime $date, $rate){
        return ($this->sum * $rate * ($date->diff($this->date, true)->days + 1) / cal_days_in_month(CAL_GREGORIAN, $date->format('n'), $date->format('Y')));
    }

    public function connectToTranch(Tranch $tranch){
        if (isset($this->tranch)){
            throw new \Exception("This investment already invested");
        $investment->connectToTranch($this);
        }
        $this->tranch = $tranch;
    }
    /**
     * Gettr fo investor
     *
     * @return Investor
     */
    public function investor(){
        return $this->investor;
    }

    /**
     * Getter for tranch
     *
     * @return String a tranch name
     */
    public function tranch(){
        return $this->tranch;
    }
    /**
     * Getter for date
     *
     * @return DateTime a tranch date
     */
    public function date(){
        return $this->date;
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
