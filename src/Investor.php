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

class Investor
{
    private $name;
    private $wallet;
    public function __construct($name, $wallet){
        $this->name = $name;
        $this->wallet = $wallet;
    }
    public function __toString(){
        return $this->name;
    }
    public function isEnoughMoney($sum){
        return $this->wallet >= $sum;
    }
    public function decrease($sum){
        $this->wallet -= $sum;
    }
}
