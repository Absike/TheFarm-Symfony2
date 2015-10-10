<?php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


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

        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setFirstname('Hassan');
        $user->setLastname('User');
        $user->setEmail('absike@outlook.com');
        $user->setPlainPassword('user123');
        $user->setRoles(array('ROLE_USER'));
        $user->setGender('male');
        $user->setPhone('(212)667876762');
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();
        $this->addReference('user', $user);

        $admin = $userManager->createUser();
        $admin->setUsername('bsiko');
        $admin->setFirstname('Hassan');
        $admin->setLastname('Absike');
        $admin->setEmail('absike@gmail.com');
        $admin->setPlainPassword('admin123');
        $admin->setRoles(array('ROLE_SUPER_ADMIN'));
        $admin->setGender('male');
        $admin->setPhone('(212)667876762');
        $admin->setEnabled(true);
        $manager->persist($admin);
        $manager->flush();
        $this->addReference('user.super_admin', $admin);


        //Generate fake user fixtures
        $faker = \Faker\Factory::create();
        $test_password = 'test';

        for ($i = 0; $i <= 30; $i++)
        {
            $fake = $userManager->createUser();
            $fake->setUsername($faker->userName);
            $fake->setEmail($faker->safeEmail);
            $fake->setFirstname($faker->firstName);
            $fake->setLastname($faker->lastName);
            $fake->setGender($faker->randomElement(array('male','female')));
            $fake->setPhone($faker->phoneNumber);
            $fake->setRoles(array('ROLE_USER'));
            $fake->setEnabled(true);
            $fake->setPlainPassword($test_password);

            $manager->persist($fake);
            $manager->flush();

            $this->addReference('user.demo_'.$i, $fake);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}