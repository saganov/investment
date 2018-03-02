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
class Loan implements LoanInterface, InvestmentReportInterface
{
    private $start;
    private $end;
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
    public function tranch(TranchInterface $tranch){
        $tranch->connectToLoan($this);
        $this->tranches[] = $tranch;
        return $this;
    }

    /**
     * Check if the provided date is in the loan dates range
     *
     * @param DateTime $date a date to check
     *
     * @return Boolean True if the date in range, False - otherwise
     */
    public function isDateAcceptable(DateTime $date){
        return ($this->start <= $date && $date <= $this->end);
    }

    /**
     * Provide report by investors
     *
     * Report includes each investors of the loan with each calculated interests
     * on the specified date
     *
     * @param DateTime $date a date which the calculation will be made on
     *
     * @throws Exception if the provided date is out of the loan date range
     *
     * @return String "<Investor name> earns <interest> pounds\n ..."
     */
    public function report(DateTime $date){
        if ($this->isDateAcceptable($date)){
            $report = [];
            foreach ($this->tranches as $tranch){
                foreach($tranch->report($date) as $investor => $interest){
                    if (key_exists((string)$investor, $report)) {
                        $report[(string)$investor] += $interest;
                    } else {
                        $report[(string)$investor] = $interest;
                    }
                }
            }
            return $report;
        } else {
            throw new \Exception("Unavailable date '{$date->format('d/m/Y')}' for the loan. Valid range is '{$this->start->format('d/m/Y')}' - '{$this->end->format('d/m/Y')}'");
        }
    }
}
