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

class Investment
{
    private $investor;
    private $sum;
    private $rate;
    private $date;
    public function __construct($investor, $sum, $rate, DateTime $date){
        $this->investor = $investor;
        $this->sum = $sum;
        $this->rate = $rate;
        $this->date = $date;
    }
    public function calculateInterest(DateTime $date){
        return ($this->sum * $this->rate * ($date->diff($this->date, true)->days + 1) / cal_days_in_month(CAL_GREGORIAN, $date->format('n'), $date->format('Y')));
    }
    public function investor(){
        return $this->investor;
    }
}
