<?php
/**
 * Created by PhpStorm.
 * User: reva
 * Date: 17.11.16
 * Time: 11:43
 */

namespace EventBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EventBundle\Entity\Event;

class LoadEventsFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $event = new Event();
        $event->setName('one');
        $event->setLocation('Kharkiv');
        $event->setDetails('xz');
        $event->setTime(new \DateTime());
        $manager->persist($event);

        $event2 = new Event();
        $event2->setName('two');
        $event2->setLocation('London');
        $event2->setDetails('xz');
        $event2->setTime(new \DateTime());
        $manager->persist($event2);

        $manager->flush();
    }
}