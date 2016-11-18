<?php
/**
 * Created by PhpStorm.
 * User: reva
 * Date: 17.11.16
 * Time: 11:43
 */

namespace UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EventBundle\Entity\Event;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUsersFixtures implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setEmail('user@email.com');
        $user->setPassword($this->encodePassword($user, 'userpass'));
        $manager->persist($user);


        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->encodePassword($user, 'adminpass'));
        $admin->setEmail('admin@email.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }


    private function encodePassword(User $user, $plainPassword)
    {
        return $this
            ->container
            ->get('security.encoder_factory')
            ->getEncoder($user)
            ->encodePassword($plainPassword, $user->getSalt());
    }
    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}