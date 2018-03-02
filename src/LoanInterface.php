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
 * A Loan class
 *
 * @author Petr Saganov <saganoff@gmail.com>
 */
interface LoanInterface
{
    /**
     * Create new tranch for the loan
     *
     * @param Tranch $tranch a new tranch for the loan
     *
     * @return Loan to chain methods
     */
    public function tranch(TranchInterface $tranch);

    /**
     * Check if the provided date is in the loan dates range
     *
     * @param DateTime $date a date to check
     *
     * @return Boolean True if the date in range, False - otherwise
     */
    public function isDateAcceptable(\DateTime $date);

    /**
     * Provide report by investors
     *
     * Report includes each investors of the loan with each calculated interests
     * on the specified date
     *
     * @param DateTime $date a date which the calculation will be made on
     *
     * @return Array [<Investor name> => <interest>, ...]
     */
    public function report(\DateTime $date);
}
