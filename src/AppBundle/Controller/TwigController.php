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
        $script = "<script>alert('salut')</script>";
        $html = "<p style='color:red'>Ce texte est en rouge</p>";

        return $this->render('twig/twig.html.twig',
            [
                'bonjour' => $bonjour,
                'tableau' => $tableau,
                'tableauAssociatif' => $tableauAssociatif,
                'datetime' => $datetime,
                'script' => $script,
                'html' => $html
            ]
        );
    }

    /**
     * Exercice :
     * Créer une route, méthode de controller, template
     * qui affiche un tableau html grâce à une variable de type
     * table passé depuis le controller
     * ce tableau est un tableau de chaines de caractères
     * et les lignes du tableau html qui contiennt une chaine
     * qui fait plus de 4 caractères doivent être écrite en rouge
     *
     *
     */

    /**
     * @Route("/exercice-twig", name="exercice_twig")
     */
    public function exerciceTwigAction() {
        $tableau = [
            'chaine numéro 1',
            'test',
            'salut',
            'un'
        ];

        return $this->render('twig/exercice_twig.html.twig',
            ['tableau' => $tableau]
        );
    }

    /**
     * @Route("/heritage-twig", name="heritage_twig")
     */
    public function heritageTwigAction() {
        return $this->render('twig/heritage_twig.html.twig');
    }

    public function renderAction() {
        $nombre = 500 * 6 / 1.5;
        return new Response($nombre);
    }

    public function renderParamAction($entier) {
        $nombre = $entier * 6 / 1.5;
        return new Response($nombre);
    }
}
