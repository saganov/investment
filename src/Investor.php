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
 * Investor class
 */
class Investor
{
    private $name;
    private $wallet;

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
     * Magick function to transfom object to string
     *
     * @return String an investor name 
     */
    public function __toString(){
        return $this->name;
    }

    /**
     * Check if the invvestor has enough money
     *
     * @param Integer $sum a sum to check if in the wallet exists enough money
     *
     * @return Boolean
     */
    public function isEnoughMoney($sum){
        return $this->wallet >= $sum;
    }

    /**
     * Decrease the amount of money in the wallet
     *
     * @param Integer $sum a sum to decrease the amount of money in the wallet
     *
     * @return void
     */
    public function decrease($sum){
        $this->wallet -= $sum;
    }
}
