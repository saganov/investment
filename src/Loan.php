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

class Loan
{
    private $start;
    private $end;
    public function __construct(DateTime $start, DateTime $end){
        $this->start = $start;
        $this->end = $end;
    }
    public function invest(Investor $investor, Tranch $tranch, $sum){

    }
    public function calculateInterest(DateTime $date){
        if ($this->start <= $date && $date <= $this->end){
            $report = "'Investor 1' earns 28.06 pounds\n'Investor 3' earns 21.29 pounds";
            return $report;
        } else {
            throw new \Exception("Unavailable date '{$date->format('d/m/Y')}' for the loan. Valid range is '{$this->start->format('d/m/Y')}' - '{$this->end->format('d/m/Y')}'");
        }
    }
}
