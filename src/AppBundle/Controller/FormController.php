<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Form\ArticleType;
use AppBundle\Form\CategoryType;
use AppBundle\Form\UserType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends Controller
{
    /**
    * Formulaire
     *
    */

    /**
     * @Route("/create-article", name="create_article")
     */
    public function formArticleAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();

        $errors = [];
        $message = "";

        if (count($request->request->all()) > 0) {
            // récupérer les valeurs du formulaire
            $title = $request->request->get('title');
            if ($title == null) {
                $errors['title'] = "Veuillez saisir un titre";
            }
            $article->setTitle($title);

            $content = $request->request->get('content');
            if ($content == null) {
                $errors['content'] = "Veuillez saisir un  contenu";
            }
            $article->setContent($content);

            $enabled = $request->request->get('enabled');
            if ($enabled == null) {
                $article->setEnabled(false);
            }
            else {
                $article->setEnabled(true);
            }

            $idCategory = $request->request->get('category');

            $category = $em->getRepository('AppBundle:Category')
                ->find($idCategory);

            if ($category instanceof Category) {
                $article->setCategory($category);
            }
            else {
                $errors['category'] = "Veuillez sélectionner une catégorie";
            }


            if (count($errors) == 0) {
                // enregistrement
                $em->persist($article);
                $em->flush();
                $message = "Enregistré avec succès";
            }
        }

        $categories = $em->getRepository('AppBundle:Category')->findAll();


        return $this->render('form/create_article.html.twig',
            [
                'errors' => $errors,
                'message' => $message,
                'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/create-article-form", name="create_article_form")
     */
    public function formArticleFormAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();

        // récupérer l'usine à formulaire
        $formFactory = $this->get('form.factory');
        $formBuilder = $formFactory->createBuilder(FormType::class, $article);

        // ajouter des champs au formulaire
        // minimum : name + type
        $formBuilder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
            ->add('enabled', CheckboxType::class, ['required' => false])
            ->add('submit', SubmitType::class)
        ;

        // récupérer l'objet form
        $form = $formBuilder->getForm();

        // dire au formulaire d'attraper l'objet pour
        // pour récupérer les valeurs transmises en POST
        // automatiquement
        $form->handleRequest($request);


        // tester si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // enregistrement en base si form valide
            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();
            }
        }

        // envoyer le formView à la vue pour affichage formulaire
        return $this->render('form/create_article_form.html.twig',
            [
                'obj' => $form,
                'form' => $form->createView(),
                'article' => $article
            ]
        );
    }

    /**
     * @Route("/create-article-type", name="create_article_type")
     */
    public function formArticleTypeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();

        // récupérer l'usine à formulaire
        $formFactory = $this->get('form.factory');
        $formBuilder = $formFactory->createBuilder(ArticleType::class, $article);

        // récupérer l'objet form
        $form = $formBuilder->getForm();

        // dire au formulaire d'attraper l'objet pour
        // pour récupérer les valeurs transmises en POST
        // automatiquement
        $form->handleRequest($request);

        // tester si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // enregistrement en base si form valide
            if ($form->isValid()) {
                $em->persist($article);
                $em->flush();
            }
        }

        // envoyer le formView à la vue pour affichage formulaire
        return $this->render('form/create_article_form.html.twig',
            [
                'obj' => $form,
                'form' => $form->createView(),
                'article' => $article
            ]
        );
    }

    /**
     *
     * Exercice :
     * Créer le formulaire pour l'entité Category
     * Créer une méthode qui utilise ce formulaire,
     * l'affiche et enregistre la catégorie quand le form est
     * soumis et valide
     *
     */

    /**
     * @Route("/create-category-type", name="create_category_type")
     */
    public function formCategoryTypeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $category = new Category();

        // récupérer l'usine à formulaire
        $formFactory = $this->get('form.factory');
        $formBuilder = $formFactory->createBuilder(CategoryType::class, $category);

        // récupérer l'objet form
        $form = $formBuilder->getForm();

        // dire au formulaire d'attraper l'objet pour
        // pour récupérer les valeurs transmises en POST
        // automatiquement
        $form->handleRequest($request);

        // le form utilise le service validator
        // pour vérifier si une entié est valide
        // grâce au fichier Resources/config/validation.yml
        // si l'entité n'est pas valide, alors $form->isValid() renvoie faux

        // tester si le formulaire a été soumis
        if ($form->isSubmitted()) {
            // enregistrement en base si form valide
            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();
            }
        }

        // envoyer le formView à la vue pour affichage formulaire
        return $this->render('form/create_category_form.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     *
     * Exercice:
     * - Créer une entité User
     *      - email (unique)
 *          - mot de passe
     *      - createdAt
     * - le createdAt doit être setté automatiquement grâce
     * au prePersist de l'entité
     *
     * - Mettre à jour la base
     * - Créer un formulaire pour ajouter un utilisateur
     * - créer des contraintes pour l'entité:
     *      - le champ email doit de type email
 *            et doit être unique
     *      - le champ mot de passe doit contenir
     *        au moins 7 caractères
     *
     *        (au moins 3 lettres, 2 chiffres et avoir au moins
     *          7 caractères)
     * - créer une méthode controller qui affiche dans un template
     * le formulaire, et qui enregistre le user si il est valide
     *
     */

    /**
     * @Route("/create-user", name="create_user")
     */
    public function addUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $formFactory = $this->get('form.factory');
        $formBuilder = $formFactory->createBuilder(UserType::class, $user);

        // récupérer l'objet form
        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
        }

        return $this->render('form/create_user.html.twig',
            [
                'form' => $form->createView()
            ]
        );

    }
}
