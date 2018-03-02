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

/**
 * Tranch interface
 */
interface TranchInterface
{
    /**
     * Connect the Tranch with particular Loan
     *
     * @param Loan $loan a Loan to connect to
     */
    public function connectToLoan(LoanInterface $loan);

    /**
     * Create a new investment
     *
     * @param Investor $investor an investment investor
     * @param Integer  $sum      an investment sum
     * @param DateTime $date     an investment date
     *
     * @return void
     */
    public function invest(InvestorInterface $investor, $sum, \DateTime $date);

    /**
     * Create report of interests of all investors in the tranch
     *
     * @param DateTime $date a report date
     *
     * @return Array [<investor name> => <interest>, ...]
     */
    public function report(\DateTime $date);
}
