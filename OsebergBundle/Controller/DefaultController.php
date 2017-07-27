<?php

namespace OsebergBundle\Controller;

//use GuzzleHttp\Psr7\Request;
use AppBundle\Controller\CodePracticeController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{
    /**
     * @Route("/home",name="home")
     */
    public function indexAction()
    {
        return $this->render('OsebergBundle:Default:index.html.twig',['word'=>'']);
    }

    /**
     * @Route("/word",name="word")
     * Get the word from the word generator
     */
    public function wordGeneratorAction()
    {
        try {
            $client = new Client();
            $generated_word = $client->request('GET', 'http://oseberg.io/interview/word_generator.php');


            if($generated_word->getStatusCode() != 200)
            throw new Exception("Request failed !!");
        }catch(Exception $e) {
            return $this->render('AppBundle:CodePractice:code_prac.html.twig',$e->getCode());

        }
            return $this->render('OsebergBundle:Default:word.html.twig',['word'=>$generated_word->getBody()->getContents()]);



    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/transform",name="transform")
     *
     * Get the transformed word
     */
    public function transformAction(Request $request)
    {

        $word = $request->request->get('gen_word');
        $client = new Client();
        $transform_word = $client->request('GET','http://oseberg.io/interview/shifter.php?word='.$word);
        return $this->render('OsebergBundle:Default:word.html.twig',['word'=>$transform_word->getBody()->getContents()]);
    }
}
