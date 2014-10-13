<?php

namespace Rsh\Bundle\TodolistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/task/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /task/");
        $crawler = $client->click($crawler->selectLink('Create a new Task')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'rsh_bundle_todolistbundle_task[description]'  => 'Test',
            'rsh_bundle_todolistbundle_task[priority]'  => '1',
            'rsh_bundle_todolistbundle_task[status]'  => '1',
            'rsh_bundle_todolistbundle_task[endDate]'  => '30-10-2014',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->request('GET', '/task/');
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'rsh_bundle_todolistbundle_task[description]'  => 'Foo',
            'rsh_bundle_todolistbundle_task[priority]'  => '2',
            'rsh_bundle_todolistbundle_task[status]'  => '2',
            'rsh_bundle_todolistbundle_task[endDate]'  => '30-11-2014',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();
        $crawler = $client->request('GET', '/task/');

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Foo")')->count(), 'Missing element td:contains("Foo")');

        // Delete the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
