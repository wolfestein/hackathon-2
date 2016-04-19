<?php

namespace Hackathon\LevelA;

class Palindrome
{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    /**
     * This function creates a palindrome with his $str attributes
     * If $str is abc then this function return abccba
     *
     * @TODO
     * @return string
     */
    public function generatePalindrome()
    {
        preg_match_all('/./us', $this->str, $ar);
        $res = implode('', array_reverse($ar[0]));

        //TEST BRANCHE MASQUE

        return $this->str.$res;
    }

}
