<?php
// src/Simple/ProfileBundle/DataFixtures/ORM/LoadUserDataFixtures.php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Papillon\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        var_dump('getting container here');
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
      $user1 = new User();
      $user1->setUsername("hassan");
      $user1->setSalt(md5(uniqid()));
      $encoder = $this->container
      	->get('security.encoder_factory')
      	->getEncoder($user1);
      $user1->setPassword($encoder->encodePassword('hassan', $user1->getSalt()));
      $user1->setEmail("absike@gmail.com");

      $manager->persist($user1);
      
      $user2 = new User();
      $user2->setUsername("bsiko");
      $user2->setSalt(md5(uniqid()));
      $encoder = $this->container
      ->get('security.encoder_factory')
      ->getEncoder($user2);
      $user2->setPassword($encoder->encodePassword('bsiko', $user2->getSalt()));
      $user2->setEmail("absike@outlook.com");
      
      $manager->persist($user2);

      $manager->flush();
    }
}