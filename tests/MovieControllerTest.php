<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieControllerTest extends WebTestCase
{
    public function testHomePageRendersEmptyForm(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $ulElement = $crawler->filter('ul');

        $this->assertEquals(0, $ulElement->filter('li')->count(), '<ul> contains some <li>');
    }

    public function testFormSubmissionRedirectsAndRetainsData()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $crawler = $client->submitForm('Dodaj film', [
            'title' => '...',
            'director_name' => '...',
            'director_surname' => '...',
        ]);

        $this->assertResponseRedirects('/', 302);
        $crawler = $client->followRedirect();
        $ulElement = $crawler->filter('ul');
        $this->assertCount(1, $ulElement->filter('li'), '<ul> should contains one <li>');
    }


    public function testEmptyPayloadOnAddEndpointReturns422()
    {
        $client = static::createClient();
        $client->request('POST', '/add');

        $this->assertResponseStatusCodeSame(422, 'Response code is not 422');
    }
}
