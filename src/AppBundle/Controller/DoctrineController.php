<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctrineController extends Controller
{
    /**
    * Doctrine
     * Gérer les entités avec Doctrine
     * CRUD
     *
    */


    /**
     * Create entity
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $article = new Article();


        return $this->render('doctrine/create.html.twig',
            [
                'article' => $article
            ]
        );
    }
}
