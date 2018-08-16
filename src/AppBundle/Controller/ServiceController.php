<?php

namespace AppBundle\Controller;

use AppBundle\Service\Lavabo;
use AppBundle\Service\Toilette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends Controller
{
    /**
    * Service
     *
     * Un service est un objet qui remplit une
     * fonction particulière
     *
     * On déclare comme service des objets dont on a
     * besoin un peu partout dans nos controllers
     *
     * On configure un objet pour le déclarer comme
     * service, et il se retrouve
     * dans le container de service de symfony
     *
     * Le container de service de symfony, met à disposition
     * tous les services, qui seront appelé
     * grâce à un identifiant
     * C'est donc le container qui se chargera
     * des dépendances
     *
    */

    /**
     * @Route("/service", name="service")
     */
    public function serviceAction() {
        // version longue de $this->render
        $twig = $this->get('twig');
        $template = $twig->render('base.html.twig');
        $response =  new Response();
        $response->setContent($template);

        // en fait on est passé nous par
        // la récupération du service twig



        // autre exemple: le routing est également un service
        // version longue de
        // $this->generateUrl('aurevoir');

        $serviceRouting = $this->get('router')->generate('aurevoir', []);
        $url = $serviceRouting;

        return $this->render('service/service.html.twig', [
            'twig' => $twig,
            'template' => $template
        ]);
    }

    public function mailAction() {
        // pour envoyer un mail en PHP, on a cette fonction
        // mail()

        // version swiftmailer
        $serviceMail = $this->get('mailer');
        //$serviceMail->send();
    }

    /**
     * Exercice : créer les deux services
     * Toilette et Lavabo
     * fonction utiliser dans les deux services
     * - création des classes
     * - déclaration en tant que service
     * - gestion des dépendances
     * (le toilette nécessite le lavabo)
     */
    public function utiliserToiletteAction() {
        // utiliser les deux classes sans services
        $toilette = new Toilette();
        $lavabo = new Lavabo();

        $toilette->utiliser();
    }
}
