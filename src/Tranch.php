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

class Tranch 
{
    private $name;
    private $rate;
    private $amount;
    public function __construct($name, $rate, $amount){
        $this->name = $name;
        $this->rate = $rate;
        $this->amount = $amount;
    }
    public function name(){
        return $this->name;
    }
    public function rate(){
        return $this->rate;
    }
    public function amount(){
        return $this->amount;
    }
    public function decrease($sum){
        $this->amount -= $sum;
    }
}
