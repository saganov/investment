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
 * Investment interface
 */
interface InvestmentInterface
{
    /**
     * Calculate the interest on the specified date for provided interest rate
     *
     * @param DateTime $date a date to calculate interest to
     * @param Float    $rate an interest rate
     *
     * @return Float
     */
    //public function calculateInterest(\DateTime $date);

    /**
     * Getter for investment sum
     *
     * @return Integer an investment sum
     */
    public function sum();
}
