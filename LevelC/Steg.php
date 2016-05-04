<?php

namespace Hackathon\LevelC;

class Steg
{
    private $src;
    private $dst;
    private $binTxt;
    public $clearTxt;
    /** Ce tableau associe nos caractères à un ensemble de bits.
     *  Ici un caractère est codé sur 6 bits. */
    private $trans = array(
        '-' => '000000',
        'a' => '000001',
        'b' => '000010',
        'c' => '000011',
        'd' => '000100',
        'e' => '000101',
        'f' => '000110',
        'g' => '000111',
        'h' => '001000',
        'i' => '001001',
        'j' => '001010',
        'k' => '001011',
        'l' => '001100',
        'm' => '001101',
        'n' => '001110',
        'o' => '001111',
        'p' => '010000',
        'q' => '010001',
        'r' => '010010',
        's' => '010011',
        't' => '010100',
        'u' => '010101',
        'v' => '010110',
        'w' => '010111',
        'x' => '011000',
        'y' => '011001',
        'z' => '011010',
        '.' => '111111',
    );

    /**
     * Cette fonction va cacher du texte dans une image
     * Avec cette technique de dissumulation, il est impossible de voir à l'oeil nu
     * que les deux images sont différentes.
     *
     * En effet, la varation de l'image porte uniquement sur la couleur bleue
     * et la dissimulation fait varier de +0 ou +1 la couleur sur une échelle de 0 à 255.
     *
     * Il a été décidé d'utiliser la technique de dissimulation dans les bits de poids faible (LSB).
     *
     * Ici, nous allons parcourir notre image, sur chacun des pixels nous allons cacher
     * dans le bit de poids faible le bit correspond à une partie de notre caractères.
     *
     * Par exemple :
     * Etape 0 : On slugifie le message (on vire les caractères spéciaux, les chiffres, ...)
     * Etape 1 : On convertit notre message de texte à binaire
     * ==> abc devient 000001 000010 000011
     * ==> Nous avons donc 18 (3*6) bits à cacher pour stocker la chaîne abc.
     * Etape 2 : On parcours l'image, et pour chaque pixel trouvé, on extrait la couleur bleue
     * ==> Pour le pixel en (1, 1), on a le triplet rouge, vert, bleu : (12, 58, 250)
     * ==> On convertit 250 en binaire 11111010
     * ==> Le premier bit de notre chaîne est '0', donc on remplace le dernier bit du bleu en '0' ce qui donne 11111010
     * ==> abc est (0)00001 000010 000011
     *
     * ==> Pour le pixel en (1, 2), on a le triplet rouge, vert, bleu : (12, 58, 233)
     * ==> On convertit 233 en binaire 11101001
     * ==> Le deuxième bit de notre chaîne est '0', donc on remplace le dernier bit du bleu en '0' ce qui donne 11101000
     * ==> abc est 0(0)0001 000010 000011
     *
     * Dés qu'on a finit de chacher le message, on arrête la traduction.
     * Nous avons préalable utiliser 6 bits de bourrage à '1', pour signifier la fin du message,
     *
     * @param $src - fichier source (un png)
     * @param $dst - fichier de destination où le texte sera caché (png)
     * @param $txt - le texte à dissumuler
     *
     * @return bool
     */
    public function hide($src, $dst, $txt)
    {
        $this->setAllForHide($src, $dst, $txt);

        // Analyse et Création de l'image
        $srcImg = ImageCreateFromPng($this->src);
        list($width, $height) = getimagesize($this->src);
        $dstImg = ImageCreateTrueColor($width, $height);

        // Sentinelle pour parcourir notre message binarisé
        $k = 0;
        // Compteur de '1', pour arrêter la conversion dés que c'est fini
        $stop = 0;

        for ($i = 0; $i < $width; ++$i) {
            for ($j = 0; $j < $height; ++$j) {

                // Extraction du triplet de couleur, r (rouge), g (vert), b (bleu)
                $rgb = imagecolorat($srcImg, $i, $j);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;

                // Tant qu'il y a des bits à planquer, on les planque.
                // Le 6x'1' signe la fin du message à cacher
                if ($stop <= 6) {
                    // La valeur est stocké dans le bit de poids faible de la couleur bleu.
                    // On regarde la valeur binaire du bleu
                    $blue = decbin($b);

                    // On remplace le dernier bit (bit de poids faible) par la valeur souhaitée.
                    $char = $this->binTxt[$k++];
                    $newBlue = substr_replace($blue, $char, -1);

                    // On convertit le tout pour que cela soit integrable dans une image
                    $b = bindec($newBlue);

                    // On gère ici la fin du "planquage" :)
                    if ('1' === $char) {
                        ++$stop;
                    } else {
                        $stop = 0;
                    }
                }

                // On initialise la couleur
                $color = imagecolorallocate($srcImg, $r, $g, $b);

                // On enregistre ce nouveau pixel dans l'image
                imagesetpixel($dstImg, $i, $j, $color);
            }
        }

        // On construit l'image
        imagepng($dstImg, $dst);

        return true;
    }

    /**
     * @TODO : A vous de faire le boulot :)
     *
     * @param $dst
     *
     * @return bool
     */
    public function show($dst)
    {
        $msg = '000010000100001000000';
        $this->bin2Text($msg);

        return true;
    }

    /**
     * Cette méthode dégueulasse permet d'initialiser le bordel (facilite le débug).
     *
     * @param $src fichier source
     * @param $dst fichier de destination
     * @param $txt message à dissimuler
     */
    private function setAllForHide($src, $dst, $txt)
    {
        $this->src = $src;
        $this->dst = $dst;
        $this->clearTxt = $txt;

        // Preparation du texte : slugify + ajout d'un caractère de fin !
        $this->binTxt = $this->text2Beats($txt);
    }

    /**
     * Cette méthode permet de purifier le message à cacher.
     *
     * @param $txt
     *
     * @return mixed|string
     */
    private function slugify($txt)
    {
        // Remplace les caracteres non alpha-numerique par des tirets
        $txt = preg_replace('~[^\pL\d]+~u', '-', $txt);

        // Un petit coup de transilération
        $txt = iconv('utf-8', 'us-ascii//TRANSLIT', $txt);

        // On vire les caracteres non-souhaités
        $txt = preg_replace('~[^-\w]+~', '', $txt);

        // Un petit coup de trim
        $txt = trim($txt, '-');

        // On vire les doubles (triple, ...) tirets
        $txt = preg_replace('~-+~', '-', $txt);

        // On mets tout en majuscule
        $txt = strtolower($txt);

        if (empty($txt)) {
            return 'n-a';
        }

        return $txt;
    }

    /**
     * Cette méthode transforme le message txt en message binaire
     * On en profite pour ajouter des bits de bourrage (/de fin).
     *
     * @param $plain
     *
     * @return string
     */
    private function text2Beats($txt)
    {
        $plain = strtr($this->slugify($txt), $this->trans);

        // Ajout de 6x1 pour marquer la fin de la chaîne.
        return $plain.'111111';
    }

    /**
     * Cette méthode transforme un texte binaire en texte.
     *
     * @param $plain
     *
     * @return string
     */
    private function bin2Text($bin)
    {
        $i = 0;
        $txt = '';
        // Suppression des bits de fin
        $len = strlen(substr($bin, 0, -6));

        while ($i < $len) {
            $sub = substr($bin, $i, 6);
            $char = array_search($sub, $this->trans);
            $txt .= $char;
            $i += 6;
        }

        $this->clearTxt = $txt;
    }
}
