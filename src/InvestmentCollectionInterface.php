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
 * Colletion of Investment objects
 */
interface InvestmentCollectionInterface
{
    /**
     * Adds new Investment to the collection
     *
     * @param Investment $investment an investment to add
     *
     * @return InvestmentCollection for chaining methods;
     */
    public function add(InvestmentInterface $investment);

    /**
     * Calculate total sum of all investments in collection
     *
     * @return Integer total of all sum's of investments in collection
     */
    public function sum();
}
