<?php

namespace UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public  function testRegister()
    {
        $client = static::createClient();

        $container = self::$kernel->getContainer();

        $em = $container->get('doctrine')->getManager();
        $userRepository = $em->getRepository('UserBundle:User');
        $userRepository->createQueryBuilder('user')->delete()->getQuery()->execute();
        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Register', $client->getResponse()->getContent());

        //submiting empty form
        $form = $crawler->selectButton('register')->form();
        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains(
            'This value should not be blank', $client->getResponse()->getContent()
        );

        //submitting filled form
        $form = $crawler->selectButton('register')->form();

        $userName = 'Test';
        $form['user_register_form[username]'] = $userName;
        $form['user_register_form[email]'] = 'test@email.com';
        $form['user_register_form[plainPassword][first]'] = 'Qwerty1';
        $form['user_register_form[plainPassword][second]'] = 'Qwerty1';

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();

        $this->assertContains(
            'Welcome ' . $userName, $client->getResponse()->getContent()
        );
    }
}
