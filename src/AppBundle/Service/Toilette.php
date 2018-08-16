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
    private $lavabo;

    /**
     * Toilette constructor.
     * Le constructeur est automatiqué appelé
     * par le container de service
     * avec les paramètres décrits dans
     * la déclaration du service (dans service.yml)
     * Ces paramètres sont à passer dans
     * le même ordre
     */
    public function __construct($lavabo) {
        $this->lavabo = $lavabo;
    }

    public function utiliser() {
        echo "Plouf";

        // sans service : voilà la dépendance
        // $lavabo = new Lavabo();

        // on  passer par le service donc toilette dépend
        $this->lavabo->utiliser();
    }
}