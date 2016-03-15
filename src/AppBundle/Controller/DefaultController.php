<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Range;
use AppBundle\Entity\Fields;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		$fields = new Fields();
	 
		 $form = $this->createFormBuilder($fields)
            ->add('name', TextType::class, array('label' => 'Имя'))
			->add('age',IntegerType::class, array('label' => 'Возраст'))
			->add('actDate', TextType::class, array('label' => 'Дата'))
			->add('file',FileType::class, array('label' => 'Резюме'))
            ->add('send', SubmitType::class, array('label' => 'Отправить'))
            ->getForm();
		  $form->handleRequest($request);
		   
		if ($form->isSubmitted() && $form->isValid()) {
             
		   
             $data = $fields->getactDate(); 
              
			 $file = $fields->getFile();
			
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
			
			$fileDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/documents';
			
            $file->move($fileDir, $fileName);
			
			$fields->setFile($fileName);
			return $this->render('default/message.html.twig',array(
			'data'=>$data,
			));
      
    }		
	 
				
        return  
		$this->render('default/index.html.twig', array(
		'form'=>$form->createView(),
		));
    }
}
