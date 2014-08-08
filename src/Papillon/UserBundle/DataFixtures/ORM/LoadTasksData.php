<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 8/8/14
 * Time: 12:44 PM
 */

namespace Papillon\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Papillon\UserBundle\Entity\Tasks;

class LoadTasksData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('low');
        $task1->setTimeSpent(40);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('low');
        $task1->setTimeSpent(70);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('high');
        $task1->setTimeSpent(20);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('high');
        $task1->setTimeSpent(30);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);


        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('normal');
        $task1->setTimeSpent(10);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('normal');
        $task1->setTimeSpent(40);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('urgent');
        $task1->setTimeSpent(50);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('urgent');
        $task1->setTimeSpent(60);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('urgent');
        $task1->setTimeSpent(80);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('urgent');
        $task1->setTimeSpent(100);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);

        $task1 = new Tasks();
        $task1->setStatus('new');
        $task1->setPriority('immediate');
        $task1->setTimeSpent(90);
        $task1->setDescription('Nothing just test demo');
        $manager->persist($task1);



        $manager->flush();
    }
}