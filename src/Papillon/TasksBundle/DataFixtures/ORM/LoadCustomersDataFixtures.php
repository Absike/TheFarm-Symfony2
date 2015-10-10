<?php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Papillon\TasksBundle\Entity\Customers;
use Papillon\TasksBundle\Entity\Tasks;


class LoadCustomersData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //Generate fake user fixtures
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 10; $i++) {

            $cst = new Customers();

            $cst->setName($faker->company);
            $cst->setAdresse($faker->address);
            $cst->setInfo($faker->freeEmailDomain);
            $cst->setFax($faker->phoneNumber);
            $cst->setPhone($faker->phoneNumber);

            $manager->persist($cst);
            $manager->flush();

            $this->addReference('customer.demo_'.$i, $cst);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}