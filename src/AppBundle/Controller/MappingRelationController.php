<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class MappingRelationController extends Controller
{
    /**
    * Mapping relation
     *
    */


    /**
     * Create entity
     * @Route("/relation", name="relation")
     */
    public function relationAction(Request $request)
    {
        $article = new Article();
        $category = $article->getCategory();

        $category = new Category();
        $category->getArticles();
    }

    /**
     * Exercice :
     * - Créer une entité Tag
     *  - createdAt : datetime
     *  - label : string
     *
     * - Liez l'article Article avec Tag
     * grâce à une relation manyToMany
     *
     * - Créer une méthode dans le controller qui ajoute
     * un tag en base : vous récupérez le nom du tag
     * dans les paramètres get (dans l'URL)
     *
     * - Créer une méthode une méthode un article
     * dans un article, suivi de tous les tags associés
     * à cet article
     *
     */
}
