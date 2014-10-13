<?php
namespace Rsh\Bundle\TodolistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\HelloBundle\Entity\User;
use Rsh\Bundle\TodolistBundle\Entity\Status;

class LoadStatusData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $metadata = $manager->getClassMetaData('Rsh\Bundle\TodolistBundle\Entity\Status');
        $metadata->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
        $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());

        $statuses = array(
            $this->createStatus(1, 'Not started'),
            $this->createStatus(2, 'In progress'),
            $this->createStatus(3, 'Verify'),
            $this->createStatus(4, 'Done'),
        );

        foreach ($statuses as $status) {
            $manager->persist($status);
        }

        $manager->flush();
    }

    /**
     * @param $id
     * @param $description
     * @return Status
     */
    private function createStatus($id, $description)
    {
        $status = new Status();
        $status->setId($id);
        $status->setDescription($description);
        return $status;
    }
}
