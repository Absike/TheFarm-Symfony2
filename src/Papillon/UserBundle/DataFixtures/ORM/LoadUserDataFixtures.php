<?php
// src/Simple/ProfileBundle/DataFixtures/ORM/LoadUserDataFixtures.php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Papillon\UserBundle\Entity\User;
use Papillon\UserBundle\Entity\Group;


class LoadUserData extends AbstractFixture implements OrderedFixtureInterface , FixtureInterface, ContainerAwareInterface
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
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $roleSA = new Group();
        $roleSA->setName('Super administrator');
        $roleSA->setRole('ROLE_SUPER_ADMIN');
        $manager->persist($roleSA);

        $roleA = new Group();
        $roleA->setName('Administrator');
        $roleA->setRole('ROLE_ADMIN');
        $manager->persist($roleA);

        $roleU = new Group();
        $roleU->setName('User');
        $roleU->setRole('ROLE_USER');
        $manager->persist($roleU);


        $user1 = new User();
        $user1->setUsername("hassan");
        $user1->setLastName('Hassan');
        $user1->setFirstName('Absike');
        $user1->setBirthDate(new \DateTime('1987-09-22'));
        $user1->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user1);
        $user1->setPassword($encoder->encodePassword('hassan', $user1->getSalt()));
        $user1->setEmail("absike@gmail.com");
        $user1->setPhone("+212 6 67 87 67 62");
        $user1->getGroups()->add($roleSA);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("bsiko");
        $user2->setLastName('user');
        $user2->setFirstName('Bsiko');
        $user2->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user2);
        $user2->setPassword($encoder->encodePassword('bsiko', $user2->getSalt()));
        $user2->setEmail("absike@outlook.com");
        $user2->getGroups()->add($roleA);
        $manager->persist($user2);


        $user3 = new User();
        $user3->setUsername("user3");
        $user3->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user3);
        $user3->setPassword($encoder->encodePassword('user3', $user3->getSalt()));
        $user3->setEmail("absike@user3.com");
        $user3->getGroups()->add($roleU);
        $manager->persist($user3);


        $user4 = new User();
        $user4->setUsername("user4");
        $user4->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user4);
        $user4->setPassword($encoder->encodePassword('user4', $user4->getSalt()));
        $user4->setEmail("absike@user4.com");
        $user4->getGroups()->add($roleU);
        $manager->persist($user4);


        $user5 = new User();
        $user5->setUsername("user5");
        $user5->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user5);
        $user5->setPassword($encoder->encodePassword('user5', $user5->getSalt()));
        $user5->setEmail("absike@user5.com");
        $user5->getGroups()->add($roleU);
        $manager->persist($user5);


        $user6 = new User();
        $user6->setUsername("user6");
        $user6->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user6);
        $user6->setPassword($encoder->encodePassword('user6', $user6->getSalt()));
        $user6->setEmail("absike@user6.com");
        $user6->getGroups()->add($roleU);
        $manager->persist($user6);

        $user7 = new User();
        $user7->setUsername("user7");
        $user7->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user7);
        $user7->setPassword($encoder->encodePassword('user7', $user7->getSalt()));
        $user7->setEmail("absike@user7.com");
        $user7->getGroups()->add($roleU);
        $manager->persist($user7);

        $user8 = new User();
        $user8->setUsername("user8");
        $user8->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user8);
        $user8->setPassword($encoder->encodePassword('user8', $user8->getSalt()));
        $user8->setEmail("absike@user8.com");
        $user8->getGroups()->add($roleU);
        $manager->persist($user8);


        $user9 = new User();
        $user9->setUsername("user9");
        $user9->setSalt(md5(uniqid()));
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($user9);
        $user9->setPassword($encoder->encodePassword('user9', $user9->getSalt()));
        $user9->setEmail("absike@user9.com");
        $user9->getGroups()->add($roleU);
        $manager->persist($user9);

        $manager->flush();

        $this->addReference('admin', $user1);
        $this->addReference('user', $user2);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}