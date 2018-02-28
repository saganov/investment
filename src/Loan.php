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
    private $investments = [];
    private $tranches    = [];
    public function __construct(DateTime $start, DateTime $end){
        $this->start = $start;
        $this->end = $end;
    }
    public function tranch($tranch){
        $this->tranches[$tranch['name']] = $tranch; 
    }
    public function invest(Investment $investment){
        $this->investments[] = $investment;
    }
    public function report(DateTime $date){
        if ($this->start <= $date && $date <= $this->end){
            $investors = [];
            foreach ($this->investments as $investment){
                $investor = $investment->investor();
                $interest = $investment->calculateInterest($date, $this->tranches[$investment->tranch()]['rate']);
                if (key_exists((string)$investor, $investors)) {
                    $investors[(string)$investor] += $interest;
                } else {
                    $investors[(string)$investor] = $interest;
                }
            }
            $report = [];
            foreach ($investors as $name => $earns){
                $report[] = sprintf("'%s' earns %01.2f pounds", $name, round($earns, 2));
            }
            return implode("\n", $report);
        } else {
            throw new \Exception("Unavailable date '{$date->format('d/m/Y')}' for the loan. Valid range is '{$this->start->format('d/m/Y')}' - '{$this->end->format('d/m/Y')}'");
        }
    }
}
