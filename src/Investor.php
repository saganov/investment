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
 * Investor class
 */
class Investor implements InvestorInterface
{
    private $name;
    private $wallet;
    private $investments = [];

    /**
     * Constructor of the Investor
     *
     * @param String $name a name of the investor
     * @param Integer $wallet an amount of money in wallet
     */
    public function __construct($name, $wallet){
        $this->name = $name;
        $this->wallet = $wallet;
    }

    /**
     * Create new Investment and register it in the loan
     *
     * @param Tranch   $tranch an investment tranch
     * @param Integer  $sum    an investment sum
     * @param DateTime $date   an investment date
     *
     * @throws Exception if sum is out of the available money in wallet
     *
     * @retun void
     */
    public function invest(TranchInterface $tranch, $sum, DateTime $date){
        if ($this->wallet >= $sum){
            $tranch->invest($this, $sum, $date);
            $this->wallet -= $sum;
        } else {
            throw new \Exception("Not enough money for the investment");
        }
    }

    /**
     * Magick function to transfom object to string
     *
     * @return String an investor name
     */
    public function __toString(){
        return $this->name;
    }
}
