<?php
// src/Simple/ProfileBundle/DataFixtures/ORM/LoadUserDataFixtures.php

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Papillon\TasksBundle\Entity\Tasks;


class LoadTasksData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
      //Generate fake user fixtures
      $faker = \Faker\Factory::create();

      for ($i = 0; $i < 50; $i++)
       {
         $task = new Tasks();
         $task->setStatus($faker->randomElement(array('high','immediate','normal','low')));
         $task->setPriority($faker->randomElement(array('new','awaiting_return','in_progress')));
         $task->setTimeSpent($faker->numberBetween($min = 0, $max = 100));
         $task->setCreatedAt($faker->dateTimeBetween($startDate = '-30 days', $endDate = 'now'));
         $task->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
         $task->setSubject($faker->realText($maxNbChars = 50, $indexSize = 2));

         $task->setAssignedBy($manager->merge($this->getReference('user.super_admin')));
         $task->setAuthor($manager->merge($this->getReference('user.demo_'.$faker->numberBetween($min = 0, $max = 30))));

         $manager->persist($task);
         $manager->flush();
      }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}