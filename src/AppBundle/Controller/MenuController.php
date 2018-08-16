<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends Controller
{
    /**
     * @Route("/page1", name="page1")
     */
    public function page1Action(Request $request)
    {
        return $this->render('menu/page1.html.twig');
    }

    /**<
     * @Route("/page2", name="page2")
     */
    public function page2Action(Request $request)
    {
        return $this->render('menu/page2.html.twig');
    }

    /**
     * @Route("/page3", name="page3")
     */
    public function page3Action(Request $request)
    {
        return $this->render('menu/page3.html.twig');
    }
}
