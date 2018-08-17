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
        // créer un article : instanciation
        $article = new Article();
        $article->setTitle("Titre article 1");
        $article->setContent("Voici le contenu de l'article");

        $now = new \DateTime();
        $article->setCreatedAt($now);

        $article->setEnabled(false);

        // récupérer le manager de doctrine
        // qui va permettre les échanges avec la BDD
        $em = $this->getDoctrine()->getManager();

        // indique à doctrine qu'il faut gérer cette objet
        // en l'enregistrant lors du prochain flush
        $em->persist($article);

        // executer les requêtes sql des objets
        // sur lesquels on a fait un persist
        $em->flush();

        // à partir d'ici, $article->getId() renvoie l'id généré

        return $this->render('doctrine/create.html.twig',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Read entity
     * @Route("/read", name="read")
     */
    public function readAction(Request $request)
    {
        // récupérer le manager doctrine
        $em = $this->getDoctrine()->getManager();

        // récupérer en base un objet grâce à son identifiant
        // getRepository correspond au type d'objet à récupérer
        // le find est la méthode permettant de faire un
        // SELECT * FROM Article WHERE id = {{id}}
        $article = $em->getRepository('AppBundle:Article')
                      ->find(1);

        if (!$article instanceof Article) {
            throw new NotFoundHttpException();
        }

        return $this->render('doctrine/create.html.twig',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Read entity
     * @Route("/read-all", name="read_all")
     */
    public function readAllAction(Request $request)
    {
        // récupérer le manager doctrine
        $em = $this->getDoctrine()->getManager();

        // récupérer en base un objet grâce à son identifiant
        // getRepository correspond au type d'objet à récupérer
        // le findAll est la méthode permettant de faire un
        // SELECT * FROM Article
        $articles = $em->getRepository('AppBundle:Article')
                      ->findAll();

        return $this->render('doctrine/read_all.html.twig',
            [
                'articles' => $articles
            ]
        );
    }

    /**
     * Exercice :
     * Créer l'entité Category avec les propriétés
     * suivantes :
     * - name
     * - createdAt
     * Vous faites une méthode dans le controller
     * qui crée une catégorie
     *
     */
    /**
     * Create entity
     * @Route("/create-category", name="create_category")
     */
    public function createCategoryAction(Request $request)
    {
        // créer une categorie : instanciation
        $category = new Category();
        $category->setName('Informatique2');
        $category->setCreatedAt(new \DateTime());

        // récupérer le manager de doctrine
        // qui va permettre les échanges avec la BDD
        $em = $this->getDoctrine()->getManager();

        // indique à doctrine qu'il faut gérer cette objet
        // en l'enregistrant lors du prochain flush
        $em->persist($category);

        // executer les requêtes sql des objets
        // sur lesquels on a fait un persist
        try {
            $em->flush();
            $message = "La catégorie a été créée.";
        }
        catch (UniqueConstraintViolationException $e) {
            $message = "La catégorie ".$category->getName()." existe déjà.";
        }

        // à partir d'ici, $category->getId() renvoie l'id généré

        return new Response($message);
    }
}
