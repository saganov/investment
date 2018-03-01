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
 * Object that represents Tranch
 */
class Tranch
{
    private $name;
    private $rate;
    private $amount;
    private $loan;
    private $investments = [];
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
    }
    public function connectToLoan(Loan $loan){
        if(isset($this->loan)){
            throw new \Exception("This tranch has already connected to a loan");
        } else {
            $this->loan = $loan;
        }
    }
    public function invest(Investor $investor, $sum, DateTime $date){
        $availableAmount = $this->availableAmount();
        if ($availableAmount < $sum){
            throw new \Exception("Only '{$availableAmount}' is available to invest");
        }
        if (!$this->loan->isDateAcceptable($date)){
            throw new \Exception("Requested date is not available");
        }
        $this->investments[] = new Investment($investor, $sum, $date, $this->rate);
    }
    private function availableAmount(){
        $availableAmount = $this->amount;
        foreach($this->investments as $investment){
            $availableAmount -= $investment->sum();
        }
        return $availableAmount;
    }
    /**
     * Getter for investments
     *
     * @return Array of investments
     */
    public function investments(){
        return $this->investments;
    }

    /**
     * Getter for interest rate
     *
     * @return Float interest rate
     */
    public function rate(){
        return $this->rate;
    }
}
