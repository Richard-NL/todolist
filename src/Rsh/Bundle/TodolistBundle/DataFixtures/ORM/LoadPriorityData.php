<?php
namespace Rsh\Bundle\TodolistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;
use Rsh\Bundle\TodolistBundle\Entity\Priority;

class LoadPriorityData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $Priorities[] = (new Priority())->setDescription('High');
        $Priorities[] = (new Priority())->setDescription('Normal');
        $Priorities[] = (new Priority())->setDescription('Low');
    
        foreach ($Priorities as $Priority) {
            $manager->persist($Priority);
        }
    
        $manager->flush();
    }
}
