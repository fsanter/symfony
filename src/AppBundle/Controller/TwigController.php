<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends Controller
{
    /**
    * TWIG
    * Génération de template avec pseudo-langage de programmation
    */
    public function twigAction() {
        return $this->render('twig/twig.html.twig');
    }
}
