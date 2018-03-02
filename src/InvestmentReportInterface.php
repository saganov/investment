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
interface InvestmentReportInterface
{
    /**
     * Create report of investments
     *
     * @param DateTime $date a report date
     *
     * @return Array [<investor name> => <interest>, ...]
     */
    public function report(\DateTime $date);
}
