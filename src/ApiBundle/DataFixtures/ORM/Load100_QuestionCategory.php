<?php


namespace ApiBundle\DataFixtures\ORM;


use AppBundle\Entity\QuestionCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Load100_QuestionCategory extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $seedData = [
            'OOP',
            'Agile',
            'MySQL',
            'PHP',
            'CSS'
        ];

        foreach ($seedData as $datum) {
            $questionCategory = new QuestionCategory;
            $questionCategory->setName($datum);

            $manager->persist($questionCategory);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 100;
    }

}
