<?php

namespace Krychenko\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KrychenkoBlogBundle:Default:index.html.twig');
    }
}
