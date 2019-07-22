<?php


namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DiaryControllerTest extends WebTestCase
{
    private $client = null;

    public function setup()
    {
        $this->client = static::createClient();
    }

    public function testHomepageIsUp()
    {
        $crawler = $this->client->request('GET', '/');
        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        static::assertSame(1, $crawler->filter('html:contains("Bienvenue")')->count());
    }

    public function testAddRecord()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/diary/add-new-record');
        $form = $crawler->selectButton("Ajouter")->form();

        $form['food[username]'] = 'Patrick Bass';
        $form['food[entitled]'] = 'sandwich de saucisse';
        $form['food[calories]'] = 600;

        $crawler = $client->submit($form);
        $client->followRedirect();

        echo $client->getResponse()->getContent();
    }
}