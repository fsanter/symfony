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

        /*
         * Inutile car le constructeur de Article
         * le fait déjà
         $now = new \DateTime();
         $article->setCreatedAt($now);
         */

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
     * Create entity
     * @Route("/update", name="update")
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // modifier un article : d'abord le récupérer
        $article = $em->getRepository('AppBundle:Article')
                      ->find(2);

        if (!$article instanceof Article) {
            throw new NotFoundHttpException();
        }

        $now = new \DateTime();
        $nowStr = $now->format('d/m/Y H:i');
        $article->setTitle("Nouveau titre ".$nowStr);

        // indique à doctrine qu'il faut gérer cette objet
        // en le modifiant lors du prochain flush

        // en fait le persist est inutile
        // car il sert à indiquer à doctrine de gérer cet objet
        // sauf que doctrine le connait déjà
        // vu qu'il a récupéré au dessus avec le find()
        // $em->persist($article);

        // executer les requêtes sql des objets
        // sur lesquels on a fait un persist
        $em->flush();

        return $this->render('doctrine/create.html.twig',
            [
                'article' => $article
            ]
        );
    }

    /**
     * Create entity
     * @Route("/delete", name="delete")
     */
    public function deleteAction() {
        $em = $this->getDoctrine()->getManager();

        // supprimer un article : d'abord le récupérer
        $article = $em->getRepository('AppBundle:Article')
                        ->find(4);

        if (!$article instanceof Article) {
            throw new NotFoundHttpException();
        }

        // indiqué à doctrine de supprimer l'article
        // lors du prochain flush
        $em->remove($article);

        $em->flush();

        return new Response("Article ".$article->getId()." supprimé");
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

    /**
     * Create entity
     * @Route("/read-custom", name="read_custom")
     */
    public function readCustomAction() {
        $em = $this->getDoctrine()->getManager();

        // sélectionnez une entité par son id
        $article = $em->getRepository('AppBundle:Article')
            ->find(4);

        // sélectionnez toutes les entités
        $articles = $em->getRepository('AppBundle:Article')
            ->findAll();

        // sélectionnez toutes les entités correspondant
        // à des critères
        // le tableau passé en paramètre de findBy
        // est un tableau où les clés doivent correspondre
        // aux propriétés mappées
        // et où chaque clé génère un AND dans la requête sql
        $articles = $em->getRepository('AppBundle:Article')
            ->findBy(['title' => 'Titre 1', 'enabled' => true]);

        // sélectionnez une entité correspondant
        // à des critères : si plusieurs entités correspondents
        // seele la première trouvée en bdd est renvoyée
        $article = $em->getRepository('AppBundle:Article')
                ->findOneBy(['enabled' => true]);

        // un article par son nom, il existe dans doctrine
        // des méthodes dynamiques
        $article = $em->getRepository('AppBundle:Article')
            ->findOneByTitle("Titre article ' 1");

        var_dump($article);


        return new Response("Custom read");
    }

    /**
     * Create entity
     * @Route("/read-custom-exo", name="read_custom_exo")
     */
    public function readCustomExoAction() {
        // 1- récupérer tous les articles de la base
        // 2- récupérer l'article dont l'identifiant est 55
        // 3 récupérer les categories dont
        // la date de création est aujourd'hui
        // 4- récupérer les articles dont le titre est
        //  soit "titre" soit "nouvel article", et sont désactivés
        // 5- récupérer les articles activés triés du plus récent
        // au plus vieux

        $em = $this->getDoctrine()->getManager();

        // 1
        $em->getRepository('AppBundle:Article')->findAll();

        // 2
        $em->getRepository('AppBundle:Article')->find(55);
        $em->getRepository('AppBundle:Article')->findOneById(55);

        // 3
        // on ne peut pas récupérer les articles d'aujourd'hui
        // car createdAt est un datetime et non un date
        // et il nous en fait récupérer tous les articles
        // doint le createdAt est compris entre 00:00:00 et 23:59:59
        // infaisable avec les méthodes findBy
        $now = new \DateTime();
        $em->getRepository('AppBundle:Category')
            ->findBy(['createdAt' => $now]);

        // 4
        $em->getRepository('AppBundle:Article')
            ->findBy(['title' => ['titre', 'nouvel article'], 'enabled' => false]);

        // même requête mais écrite dans le repo custom
        $em->getRepository('AppBundle:Article')
            ->findByTitleAndEnabled();

        // 5
        $em->getRepository('AppBundle:Article')
            ->findBy(['enabled' => true], ['createdAt' => 'DESC']);

        // 6 tous les articles triés du plus récent au plus vieux
        $em->getRepository('AppBundle:Article')
            ->findBy([], ['createdAt'=> 'DESC']);

        return new Response("Custom read exo");
    }

    /**
     * custom repository
     * @Route("/custom-repository", name="custom_repository")
     */
    public function customRepositoryAction() {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')
                        ->findByCreatedAtNow();

        /*
         *
         * Exercice :
         * Ecrire dans le repo custom, le code qui permet à doctrine :
         * 1- de récupérer tous les articles dont l'id est supérieur à 3
         * et dont la date de création est en août 2018
         * 2- récupérer tous les articles activés et créés en 2018
         */

        // tous les articles dont id > 3 et de août 2018
        $articles1 = $em->getRepository('AppBundle:Article')
            ->findId3Createdat082018();

        // tous les articles activés de 2018
        $articles2 = $em->getRepository('AppBundle:Article')
            ->findByEnabled2018();

        // tous les articles de 2018
        $articles2018 = $em->getRepository('AppBundle:Article')
            ->findByYear(2018);

        // tous les articles de 2017
        $articles2017 = $em->getRepository('AppBundle:Article')
            ->findByYear(2017);

        // tous les articles de 2016 triés par ordre alphabétique sur le titre
        $articles2016 = $em->getRepository('AppBundle:Article')
            ->findByYearOrderedTitle(2016);

        return $this->render('doctrine/custom_repo.html.twig',
            [
                'articles' => $articles
            ]
        );
    }
}
