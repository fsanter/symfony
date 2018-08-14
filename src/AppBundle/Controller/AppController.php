<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    public function indexAction(Request $request)
    {
        return new Response("app test");
    }

    /**
     * Exercice : créer sur ce modèle une nouvelle page
     * qui affiche : "salut"
     * cette méthode ne passe pas par un
     * tempalte twig
     */
    public function salutAction(Request $request)
    {
        return new Response("salut");
    }

    /**
     * Exercice : créer une nouvelle page
     * qui affiche le contenu d'un template twig :
     * "bonjour<br>"
     *
     * 1 route : 1 controller : 1 template
     */
    public function bonjourAction(Request $request)
    {
        return $this->render('app/bonjour.html.twig');
    }

    /**
     * Exercice : créer une nouvelle page
     * qui affiche le contenu d'un template twig :
     * vous mettez ce que vous voulez dans le template
     * 1 route : 1 controller : 1 template
     * route aurevoir
     */
    public function aurevoirAction() {
        $now = date('d/m/Y');
        return $this->render('app/aurevoir.html.twig',
            [
                'dateActuelle' => $now
            ]
        );
    }

    /**
     * Exercice : créer une nouvelle page
     * qui affiche le contenu d'un template twig :
     * dans ce template vous passez un objet datetime
     * qui contient la date actuelle
     * 1 route : 1 controller : 1 template
     * route now
     */
    public function nowAction() {
        $dateTime = new \DateTime();

        return $this->render('app/now.html.twig',
            [
                'dateActuelleDateTime' => $dateTime
            ]
        );
    }

    /**
     * Exercice : créer une nouvelle page
     * qui affiche un lien vers la page now :
     * 1 route : 1 controller : 1 template
     * route routing
     */
    public function routingAction() {
        // méthode pour générer une url depuis un controller
        // grâce à un nom de route
        // équivalent de path() en twig
        $urlAurevoir = $this->generateUrl('aurevoir');

        return $this->render('app/routing.html.twig',
            [
                'urlAurevoir' => $urlAurevoir
            ]
        );
    }


    /**
     * Exercice : Créer un mini site de trois pages
     * grâce à un nouveau controller
     * Vous créez les routes comme vous voulez :
     *  - soit importées via le controlleur en annotation
     *  - soit directement dans le fichier routing
     * Vous créez 3 templates avec un pour chaque page
     * avec dans chacun, un lien vers chacune
     * des trois pages
     *
     */

    /**
     * Exercice:
     * Inclure une image dans le template
     * routing.html.twig
     *
     */


    /**
     * Routing avec paramètre
     */

    public function routingParametersAction($id) {
        return $this->render('app/routing_parameters.html.twig',
            [
              'id' => $id
            ]
        );
    }


    /** Exercice : créer une route avec
     * un paramètre dynamique
     * et lui donner la valeur par défaut 'test'
     * et afficher cette valeur dans un nouveau template
     */
    public function routingParametersTestAction($test) {
        // génération d'une url pour une route qui attend
        // des paramètres
        $url = $this->generateUrl('routing_parameters', ['id'=> 123]);

        return $this->render('app/routing_parameters_test.html.twig', [
            'test' => $test,
            'urlAvecParametre' => $url
        ]);
    }

    public function routingParameters2Action($test, $param, $param2) {
        return new Response($test);
    }
}
