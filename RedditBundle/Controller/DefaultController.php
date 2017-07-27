<?php

namespace RedditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;
use Symfony\Component\Config\Definition\Exception\Exception;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name ="hot feeds")
     */
    public function HotAction()
    {

        $client = new Client();
        try {
           $responseh = $client->request('GET', 'https://www.reddit.com/hot.json');
        }
        catch(Exception $exception)
        {
            error_log($exception->getMessage());
        }

        $arrayh= \GuzzleHttp\json_decode($responseh->getBody());
        return $this->render('RedditBundle:Default:index.html.twig',['resph'=>$arrayh->data]);

    }

    /**
     * @Route("/",name="new feeds")
     */
    public function NewAction()
    {
        $client = new Client();
        $responsen = $client->request('GET','https://www.reddit.com/new.json');
        $arrayn = \GuzzleHttp\json_decode($responsen->getBody());
        return $this->render('RedditBundle:Default:new.html.twig',['respn'=>$arrayn->data]);

    }
}
