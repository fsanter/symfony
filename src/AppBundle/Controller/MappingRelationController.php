<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Tag;
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
     * - Liez l'entité Article avec Tag
     * grâce à une relation manyToMany
     *
     * - Créer une méthode dans le controller qui ajoute
     * un tag en base : vous récupérez le nom du tag
     * dans les paramètres get (dans l'URL)
     * En associant à un article ce tag
     *
     * - Créer une méthode qui affiche un article
     * dans un template, suivi de tous les tags associés
     * à cet article
     *
     */

    /**
     * Create entity tag
     * @Route("/create-tag", name="create_tag")
     */
    public function createTagAction(Request $request) {
        // récupérer les paramètres GET
        $nomTag = $request->query->get('tag');

        // création du tag
        $tag = new Tag();
        $tag->setLabel($nomTag);

        // enregistrement du tag
        $em = $this->getDoctrine()->getManager();
        $em->persist($tag);

        // récupérer un article
        $article = $em->getRepository('AppBundle:Article')
                    ->find(1);

        if (!$article instanceof Article) {
            throw new NotFoundHttpException();
        }

        // associer au tag
        // pour le persist de la liaison, il faut un addEntity
        // sur l'entité qui a le inversedBy
        $tag->addArticle($article);

        // OU
        //  $article->addTag($tag);

        try {
            $em->flush();
            $message = "Tag créé";
        }
        catch(UniqueConstraintViolationException $e) {
            $message = 'tag déjà existant';
        }

        return new Response($message);
    }

    /**
     * display article with tags
     * @Route("/display-article", name="display_article")
     */
    public function displayArticleAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        // récupération d'une entité article
        // mais le tableau de tags est vide
        $article = $em->getRepository('AppBundle:Article')
                    ->find(1);

        return $this->render('doctrine/display_article.html.twig',
            [
                'article' => $article
            ]
        );
    }
}
