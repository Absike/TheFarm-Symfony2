<?php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Papillon\TasksBundle\Entity\Customers;
use Papillon\TasksBundle\Entity\Projects;
use Papillon\TasksBundle\Entity\Tasks;


class LoadProjectsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //Generate fake user fixtures
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {

            $project = new Projects();

            $project->setName($faker->company);
            $project->setCustomers($manager->merge($this->getReference('customer.demo_'.$faker->numberBetween($min = 0, $max = 10))));
            $project->setDateOpening($faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'));
            $project->setDateClosing($faker->dateTimeBetween($startDate = '+30 days', $endDate = '+1 years'));
            $project->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));

            $manager->persist($project);
            $manager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}