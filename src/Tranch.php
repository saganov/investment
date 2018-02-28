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
 * Object that represents Tranch
 */
class Tranch 
{
    private $name;
    private $rate;
    private $amount;

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

    /**
     * Getter for Tranch name
     *
     * @return String name of the tranch
     */
    public function name(){
        return $this->name;
    }

    /**
     * Getter for interest rate
     *
     * @return Float interest rate 
     */
    public function rate(){
        return $this->rate;
    }

    /**
     * Getter for maximum investment amount
     *
     * @return Integer maximum investment amount
     */
    public function amount(){
        return $this->amount;
    }

    /**
     * Decrease the maximum amount of investment
     *
     * @param Integer $sum a sum to decrease
     *
     * @return void
     */
    public function decrease($sum){
        $this->amount -= $sum;
    }
}
