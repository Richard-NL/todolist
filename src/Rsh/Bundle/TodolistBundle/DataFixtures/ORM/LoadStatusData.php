<?php
namespace Rsh\Bundle\TodolistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;
use Rsh\Bundle\TodolistBundle\Entity\Status;

class  LoadStatusData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $statuses[] = (new Status())->setDescription('Not started');
        $statuses[] = (new Status())->setDescription('In progress');
        $statuses[] = (new Status())->setDescription('Verify');
        $statuses[] = (new Status())->setDescription('Done');

        foreach ($statuses as $status) {
            $manager->persist($status);
        }

        $manager->flush();
    }
}