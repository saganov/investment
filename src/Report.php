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
use DateTime;

/**
 * A Report class to provide string output
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
class Report implements InvestmentReportInterface
{
    private $loan;
    private $template;
    /**
     * Report Constructor
     *
     * @param InvestmentReportInterface $loan     a loan to provide report for
     * @param String                    $template a string template to output
     *
     * @return Report
     */
    public function __construct(InvestmentReportInterface $loan, $template = "'%s' earns %01.2f pounds"){
        $this->loan     = $loan;
        $this->template = $template;
    }

    /**
     * Provide report by investors
     *
     * Report includes each investors of the loan with each calculated interests
     * on the specified date
     *
     * @param Loan $loan a loan to provide report to
     *
     * @return String "<Investor name> earns <interest> pounds\n ..."
     */
    public function report(DateTime $date){
        $report = [];
        foreach($this->loan->report($date) as $name => $interest){
            $report[] = sprintf($this->template, $name, round($interest, 2));
        }
        return implode("\n", $report);
    }
}
