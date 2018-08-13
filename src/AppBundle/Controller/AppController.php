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

}
