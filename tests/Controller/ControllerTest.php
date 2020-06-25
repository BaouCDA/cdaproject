<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ControllerTest extends WebTestCase
{
    //Verifie que la route est accessible
    public function testRoute(){
        $client = static::createClient();
        $client->request('GET', '/accueil');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    //Verifie que la route amene sur la page souhaité
    public function testRouteContains(){
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSelectorTextContains('h2', 'Inspire le monde');
    }
    //Redirige un utilisateur non identifié
    public function testRoutePage(){
        $client = static::createClient();
        $client->request('GET', '/membre/administration');
        $this->assertResponseRedirects();    
    }
    //Test de l'identification
    public function testAddAuth()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Connexion')->form();
        $form['_username'] = 'cda';
        $form['_password'] = '00000000';
        $crawler=$client->submit($form);

        $client->followRedirect();
        echo $client->getResponse()->getContent();
        $this->assertSelectorTextContains('html a.nav-link', 'mon espace');
    }
    



}