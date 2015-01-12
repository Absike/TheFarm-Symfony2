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
        $task1 = new Tasks();
        $task1->setStatus("high");
        $task1->setPriority('new');
        $task1->setAssignedBy($manager->merge($this->getReference('admin')));
        $task1->setAuthor($manager->merge($this->getReference('admin')));
        $manager->persist($task1);

        $task2 = new Tasks();
        $task2->setStatus("normal");
        $task2->setPriority('Progress');
        $task2->setAssignedBy($manager->merge($this->getReference('admin')));
        $task2->setAuthor($manager->merge($this->getReference('user')));
        $manager->persist($task2);

        $task3 = new Tasks();
        $task3->setStatus("immediate");
        $task3->setPriority('awaiting_return');
        $task3->setAssignedBy($manager->merge($this->getReference('admin')));
        $task3->setAuthor($manager->merge($this->getReference('admin')));
        $manager->persist($task3);

        $task4 = new Tasks();
        $task4->setStatus("low");
        $task4->setPriority('new');
        $task4->setAssignedBy($manager->merge($this->getReference('admin')));
        $task4->setAuthor($manager->merge($this->getReference('user')));
        $manager->persist($task4);

        $task5 = new Tasks();
        $task5->setStatus("urgent");
        $task5->setPriority('in_progress');
        $task5->setAssignedBy($manager->merge($this->getReference('admin')));
        $task5->setAuthor($manager->merge($this->getReference('admin')));
        $manager->persist($task5);


        $task6 = new Tasks();
        $task6->setStatus("low");
        $task6->setPriority('high');
        $task6->setAssignedBy($manager->merge($this->getReference('admin')));
        $task6->setAuthor($manager->merge($this->getReference('user')));
        $manager->persist($task6);

        $task7 = new Tasks();
        $task7->setStatus("low");
        $task7->setPriority('normal');
        $task7->setAssignedBy($manager->merge($this->getReference('admin')));
        $task7->setAuthor($manager->merge($this->getReference('admin')));
        $manager->persist($task7);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}