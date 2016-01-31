<?php

namespace Runator\TradBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
#use Runator\TradBundle\Entity\Translate as Translate;
#use Runator\TradBundle\Entity\Language as Language;
#use Symfony\Component\HttpFoundation\Response;


class TranslateController extends FOSRestController
{
    //http://localhost/runator/Symfony/web/app_dev.php/api/all-translates.json
    public function getTranslatesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $translates = $em->getRepository('RunatorTradBundle:Translate')->findAll();
        $view = $this->view($translates, 200)
            ->setTemplate("RunatorTradBundle:Translate:getTranslates.html.twig")
            ->setTemplateVar('translates')
        ;

        return $this->handleView($view);
    }

    //http://localhost/runator/Symfony/web/app_dev.php/api/translate.json?language=Español
	//http://localhost/runator/Symfony/web/app_dev.php/api/translate.json?token=_hola&language=Español
    public function getTranslateAction(Request $request) {
        $token = trim($request->query->get('token','_')); //requerido
        $language = trim($request->query->get('language','_')); //requerido
        
        $search = array();
        if($token!='_'){
            $search['token'] = $token;
        }
        if($language!='_'){
            $search['language'] = $language;
        }
        $em = $this->getDoctrine()->getManager();
        $translates = $em->getRepository('RunatorTradBundle:Translate')->findBy($search);
        $view = $this->view($translates, 200)
            ->setTemplate("RunatorTradBundle:Translate:getTranslate.html.twig")
            ->setTemplateVar('translate')
        ;

        return $this->handleView($view);
        
    }
}
