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
        $metadata = $manager->getClassMetaData('Rsh\Bundle\TodolistBundle\Entity\Priority');
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());

        $priorities = array(
            $this->createPriority(1, 'High'),
            $this->createPriority(2, 'Normal'),
            $this->createPriority(3, 'Low')
        );
    
        foreach ($priorities as $priority) {
            $manager->persist($priority);
        }
    
        $manager->flush();
    }

    /**
     * @param $id
     * @param $description
     * @return Priority
     */
    private function createPriority($id, $description)
    {
        $priority = new Priority();
        $priority->setId($id);
        $priority->setDescription($description);
        return $priority;
    }
}
