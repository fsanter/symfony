<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends Controller
{
    /**
     * @Route("/request", name="request")
     */
    public function requestAction(Request $request)
    {
        // récupérer un paramètre GET
        // avant $_GET['cle']
        $paramGet = $request->query->get('paramget');

        // récupérérer un paramètre POST
        // avant $_POST['cle']
        // $request->request
        $paramPost = $request->request->get('nom');

        return $this->render('request/request.html.twig',
            [
                'request' => $request,
                'paramGet' => $paramGet,
                'paramPost' => $paramPost
            ]);
    }

    /** Créer dans le template ci-dessus un formulaire en POST
        avec un seul champ, et récupérer cette valeur lors de la
     * soumission du formulaire.
     * Affichez cette valeur dans le template à côté de
     * "Paramètre POST :"
     */

}
