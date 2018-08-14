<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends Controller
{
    /**
    * TWIG
    * Génération de template avec pseudo-langage de programmation
    */

    /**
     * @Route("/twig", name="twig")
     */
    public function twigAction() {
        $bonjour = "Bonjour tout le monde";
        $tableau = ['élément 1', 'chaine2', 56, true, ['salut']];
        $tableauAssociatif = [
            'clenumero1' => "Valeur numéro 1",
            'prenom' => 'Fab'
        ];
        $datetime = new \DateTime();

        return $this->render('twig/twig.html.twig',
            [
                'bonjour' => $bonjour,
                'tableau' => $tableau,
                'tableauAssociatif' => $tableauAssociatif,
                'datetime' => $datetime
            ]
        );
    }
}
