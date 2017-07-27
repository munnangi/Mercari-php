<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CodePracticeControllerTest extends WebTestCase
{
    public function testCodeprac()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/practice');
    }

}
