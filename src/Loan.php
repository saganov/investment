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
 * A Loan class
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
class Loan
{
    private $start;
    private $end;
    private $investments = [];
    private $tranches    = [];

    /**
     * Loan Constructor
     *
     * @param DateTime $start Date of start of the loan
     * @param DateTime $end   Date of end of the loan
     *
     * @return Loan
     */
    public function __construct(DateTime $start, DateTime $end){
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Create new tranch for the loan
     *
     * @param Tranch $tranch a new tranch for the loan
     *
     * @return Loan to chain methods
     */
    public function tranch(Tranch $tranch){
        $this->tranches[$tranch->name()] = $tranch;
        return $this;
    }

    /**
     * Create new investmnt for this loan 
     *
     * @param Investment $investment new investment
     *
     * @return Loan to chain methods
     */
    public function invest(Investment $investment){
        if (!$investment->investor()->isEnoughMoney($investment->sum())){
            throw new \Exception("Insufficient funds for investment requested: '{$investment->sum()}'");
        }
        $tranch = $investment->tranch();
        if (key_exists($tranch, $this->tranches)){
            if ($this->tranches[$tranch]->amount() >= $investment->sum()){
                $this->investments[$tranch] = $investment;
                $this->tranches[$tranch]->decrease($investment->sum());
            } else {
                throw new \Exception("Tranch limit for '{$tranch}' exceeded");
            }
        } else {
            throw new \Exception("Unknown Tranch '{$tranch}'");
        }
        return $this;
    }

    /**
     * Provide report by investors
     *
     * Report includes each investors of the loan with each calculated interests
     * on the specified date
     *
     * @param DateTime $date a date which the calculation will be made on
     */
    public function report(DateTime $date){
        if ($this->start <= $date && $date <= $this->end){
            $investors = [];
            foreach ($this->investments as $tranch => $investment){
                $investor = $investment->investor();
                $interest = $investment->calculateInterest($date, $this->tranches[$tranch]->rate());
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
