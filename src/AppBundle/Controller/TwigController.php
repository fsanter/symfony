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

    /**
     * méthode appelée depuis un render
     * dans un template twig
     * pas besoin de définir une route
     */
    public function renderAction() {
        $nombre = 500 * 6 / 1.5;
        return new Response($nombre);
    }

    /**
     * méthode avec paramètre appelée depuis un render
     * dans un template twig
     * pas besoin de définir une route
     */
    public function renderParamAction($entier) {
        $nombre = $entier * 6 / 1.5;
        return new Response($nombre);
    }

    /**
     *
     * Exercice :
     * Créer une nouvelle page dans ce controller
     * route, méthode controller, template
     *
     * Côté controller :
     * - déclarer une variable de type tableau numérique
     * - remplir dans avec des noms et prénoms (tableau associatif)
     *
     * - passer ce tableau au template
     *
     * - ce template doit hériter du template base.html.twig
     * puis redéfinir le block body
     * pour y créer un tableau html qui affiche
     * tous les noms et prénoms (un nom et prénom par ligne)
     *
     * - ce template doit inclure un controller
     * (nouvelle méthode controller)
     * - cette méthode doit renvoyer sous forme de chaine
     * la date actuelle + 2 jours
     * et indiquer donc dans le template :
     * "Dans deux jours nous serons le :" {{ date+2 }}
     *
     *
     *
     *
     */

    /**
     * @Route("/exo-heritage-twig", name="exo_heritage_twig")
     */
    public function exoHeritageTwigAction() {
        $tab = [];
        $tab[] = ['nom' => 'Nomtest', 'prenom' => 'Prenomtest'];
        $tab[] = ['nom' => 'Nomtest2', 'prenom' => 'Prenomtest2'];
        $tab[] = ['nom' => 'Nomtest3', 'prenom' => 'Prenomtest3'];
        $tab[] = ['nom' => 'Nomtest4', 'prenom' => 'Prenomtest4'];

        $response = $this->render('twig/exo_heritage_twig.html.twig',
            [
                'tab' => $tab
            ]
        );

        return $response;
    }

    public function exoRenderAction() {
        $now = new \DateTime();

        // avec la méthode modify du datetime
        $now->modify('+2 day');

        // équivalent avec DateInterval
        $dateInterval = new \DateInterval("P2D");
        //$now->add($dateInterval);

        // si je veux ajouter 2 jours, 2 heures et 2 minutes
        $dateInterval = new \DateInterval("P2DT2H2M");
        $now->add($dateInterval);

        // au total, on a donc ajouté 4 jours, 2 heures et 2 minutes

        return new Response($now->format("d/m/Y H:i:s"));
    }
}
