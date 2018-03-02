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
 * Investor interface
 */
interface InvestorInterface
{
    /**
     * Create new Investment
     *
     * @param Tranch   $tranch an investment tranch
     * @param Integer  $sum    an investment sum
     * @param DateTime $date   an investment date
     */
    public function invest(TranchInterface $tranch, $sum, \DateTime $date);

    /**
     * Magick function to transfom object to string
     *
     * @return String an investor name
     */
    public function __toString();
}
