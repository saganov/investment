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
 * Colletion of Investment objects
 */
class InvestmentCollection implements InvestmentCollectionInterface, InvestmentReportInterface
{
    private $collection = [];

    /**
     * Adds new Investment to the collection
     *
     * @param Investment $investment an investment to add
     *
     * @return InvestmentCollection for chaining methods;
     */
    public function add(InvestmentInterface $investment){
        $this->collection[] = $investment;
        return $this;
    }

    /**
     * Calculate total sum of all investments in collection
     *
     * @return Integer total of all sum's of investments in collection
     */
    public function sum(){
        $sum = 0;
        foreach($this->collection as $investment){
            $sum += $investment->sum();
        }
        return $sum;
    }

    /**
     * Create report by investors and their interests on the specified date
     *
     * @param DateTime $date a report date
     *
     * @return Array [<investor name> => <interest>, ...]
     */
    public function report(DateTime $date){
        $report = [];
        foreach ($this->collection as $investment){
            foreach($investment->report($date) as $name => $interest){
                if (key_exists($name, $report)) {
                    $report[$name] += $interest;
                } else {
                    $report[$name] = $interest;
                }
            }
        }
        return $report;
    }
}
