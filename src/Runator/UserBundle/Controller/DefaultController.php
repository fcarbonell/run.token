<?php

namespace Runator\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RunatorUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
