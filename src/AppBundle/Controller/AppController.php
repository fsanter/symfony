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
}
