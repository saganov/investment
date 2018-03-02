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
use Investment\InvestmentCollection;
/**
 * Object that represents Tranch
 */
class Tranch implements TranchInterface
{
    private $name;
    private $rate;
    private $amount;
    private $loan;
    private $investments;
    /**
     * Constructor
     *
     * @param String $name a name of the tranch to identify it within the others
     * @param Float  $rate an interest rate of the tranch
     * @param Integer $amount a maximum amount of investments
     *
     * @return Tranch
     */
    public function __construct($name, $rate, $amount){
        $this->name = $name;
        $this->rate = $rate;
        $this->amount = $amount;
        $this->investments = new InvestmentCollection();
    }

    /**
     * Connect the Tranch with particular Loan
     *
     * @throws Exception if the tranch already connected
     *
     * @param Loan $loan a Loan to connect to
     */
    public function connectToLoan(LoanInterface $loan){
        if(isset($this->loan)){
            throw new \Exception("This tranch has already connected to a loan");
        } else {
            $this->loan = $loan;
        }
    }

    /**
     * Create investment and add it to the collection
     *
     * @param Investor $investor an investment investor
     * @param Integer  $sum      an investment sum
     * @param DateTime $date     an investment date
     *
     * @throws Exception if the provided sum is bigger than the amount available to invest
     * @throws Exception if the provided date is out of the loan date range
     *
     * @return void
     */
    public function invest(InvestorInterface $investor, $sum, DateTime $date){
        $availableAmount = $this->amount - $this->investments->sum();
        if ($availableAmount < $sum){
            throw new \Exception("Only '{$availableAmount}' is available to invest");
        }
        if (!$this->loan->isDateAcceptable($date)){
            throw new \Exception("Requested date is not available");
        }
        $this->investments->add(new Investment($investor, $sum, $date, $this->rate));
    }

    /**
     * A proxy to the InvestmentsCollection::report method
     *
     * @param DateTime $date a report date
     *
     * @return Array [<investor name> => <interest>, ...]
     */
    public function report(DateTime $date){
        return $this->investments->report($date);
    }
}
