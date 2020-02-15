<?php

class Wheel
{
    /*
     * this function returns a random roulette roll
     * @return object
     */
    public function roll(): object
    {
        $colors = ['red', 'black'];
        $number = mt_rand(1, 36);
        $randomKey = array_rand($colors);
        $color = $colors[$randomKey];
        $remainder = $number % 2;

        $oddOrEven = 'odd';
        if($remainder === 0){
            $oddOrEven = 'even';
        }

        return (object) [
            'number'    => $number,
            'color'     => $color,
            'oddOrEver' => $oddOrEven
        ];
    }
}