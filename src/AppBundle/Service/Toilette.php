<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 16/08/2018
 * Time: 15:10
 */

namespace AppBundle\Service;


class Toilette
{
    public function utiliser() {
        echo "Plouf";

        // sans service : voilà la dépendance
        $lavabo = new Lavabo();
        $lavabo->utiliser();
    }
}