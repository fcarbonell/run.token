<?php

namespace Runator\TradBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Runator\TradBundle\Entity\Translate as Translate;
use Runator\TradBundle\Entity\Language as Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Runator\TradBundle\Form\TranslateType;
use Runator\TradBundle\Form\LanguageType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunatorTradBundle:Default:index.html.twig');
    }

    /* Lo hacemos mediante FosUserBundle resetting pass
    public function sendNewPasswordAction($email, Request $request ){
    	$password = '123';
    	$userManager = $this->get('fos_user.user_manager');
		$user = $userManager->findUserBy(array('email' => $email));
		$user->setPlainPassword($password);	
		$userManager->updateUser($user, true);

		$request->getSession()->getFlashBag()->set('notice', 'Vas a recibir un email con tus nuevas credenciales de acceso');

		return $this->redirect($this->generateUrl('runator_trad_homepage'));
    }*/

    public function deleteAction($token, $language, Request $request){
    	$em = $this->getDoctrine()->getManager();
    	$translate_to_delete = $em->getRepository('RunatorTradBundle:Translate')->findOneBy(array('language' => $language,'token' => $token));
    	if($translate_to_delete){
    		$em->remove($translate_to_delete);
			$em->flush();
			$request->getSession()->getFlashBag()->set('notice', 'Token eliminado correctamente');
    	}else{
    		$request->getSession()->getFlashBag()->set('notice', 'Token no se ha podido eliminar');
    	}
    	return $this->redirect($this->generateUrl('runator_trad_admin'));
    }

    public function adminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $translate = new Translate();
        $form = $this->createForm(new TranslateType(), $translate);
        //form de idiomas
        $language = new Language();
        $formIdiomas = $this->createForm(new LanguageType(), $language);

        if ($request->request->has("runator_tradbundle_language")) {
		   $formIdiomas->handleRequest($request);
		   $language_duplicada = $em->getRepository('RunatorTradBundle:Language')->findBy(array('codigo' => $language->getCodigo()));
    		if($language_duplicada){
    			$request->getSession()->getFlashBag()->set('notice', 'Error el idioma ya existe');
    		}else{
    			// guardar la tarea en la base de datos
	        	$em->persist($language);
	    		$em->flush();
	    		$request->getSession()->getFlashBag()->set('notice', 'Idioma insertado correctamente');
    			unset($language);
    			unset($formIdiomas);
    			$formIdiomas = $this->createForm(new LanguageType(), new Language());
    		}

		}else{
			$form->handleRequest($request);
	 		if ($form->isValid()) {
	    		$translate_duplicada = $em->getRepository('RunatorTradBundle:Translate')->findBy(array('language' => $translate->getLanguage()->getName() ,'token' => $translate->getToken()));
	    		if($translate_duplicada){
	    			$request->getSession()->getFlashBag()->set('notice', 'El token '.$translate->getToken().' ya existe para el idioma '.$translate->getLanguage());
	    		}else{
	    			// guardar la tarea en la base de datos
		        	$em->persist($translate);
		    		$em->flush();
		    		$request->getSession()->getFlashBag()->set('notice', 'Token insertado correctamente');
	    			unset($translate);
	    			unset($form);
	    			$form = $this->createForm(new TranslateType(), new Translate());
	    		}
	        	//return $this->redirect($this->generateUrl('task_success'));
	    	}	
		}

        

    	$translates = $em->getRepository('RunatorTradBundle:Translate')->findAll();

 
        return $this->render('RunatorTradBundle:Admin:index.html.twig', array('formIdiomas'=>$formIdiomas->createView(), 'translates' => $translates,'form' => $form->createView()));
    }
}
