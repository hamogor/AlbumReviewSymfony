<?php

namespace ReviewBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review_create/{album_id}');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review_edit/{review_id}');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review_delete/{review_id}');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review_view/{review_id}');
    }

}
