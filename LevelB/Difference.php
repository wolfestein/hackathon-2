<?php

namespace Hackathon\LevelB;

/**
 * Class Difference
 * En réalité, il suffit d'implémenter un algorythme bien spécifique.
 * http://jeux-et-mathematiques.davalan.org/lang/algo/lev/index.html
 * https://openclassrooms.com/forum/sujet/distance-de-levenshtein-79426.
 */
class Difference
{
    private $a;     // Chaine A
    private $b;     // Chaine A
    public $cost;   // Coût de changement

    /**
     * @param $a    // Chaine A
     * @param $b    // Chaine B
     */
    public function __construct($a, $b)
    {
        $this->a = $a;
        $this->b = $b;
        $this->cost = $this->whatIsTheCostPlease($a, $b);
    }

    /**
     * @param $this->a
     * @param $this->b
     *
     * @return mixed
     */
    public function whatIsTheCostPlease()
    {
        // @ TODO
        $lenA = strlen($this->a);
        $lenB = strlen($this->b);

        for ($i = 1; $i <= $lenA; ++$i) {
            for ($j = 1; $j <= $lenB; ++$j) {
                $c = ($this->a[$i - 1] === $this->b[$j - 1]) ? 0 : 1;
                $matrix[$i][$j] = 0;
            }
        }

        return $matrix[$lenA][$lenB];
    }
}
