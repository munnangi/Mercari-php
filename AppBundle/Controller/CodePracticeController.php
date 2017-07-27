<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Config\Definition\Exception\Exception;

class CodePracticeController extends Controller
{
    /**
     * @Route("/practice")
     */
    public function codePracAction()
    {
        try{

            $error = "Try Throw Catch exception handling";

            throw new Exception($error);
        }
        catch(Exception $e){

            return $this->render('AppBundle:CodePractice:code_prac.html.twig', ['message'=> $e->getCode()]);
        }


    }

}
