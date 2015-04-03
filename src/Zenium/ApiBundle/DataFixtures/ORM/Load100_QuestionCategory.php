<?php


namespace Zenium\ApiBundle\DataFixtures\ORM;


use Zenium\AppBundle\Entity\QuestionCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Loads Question Category fixtures.
 *
 * @package ApiBundle\DataFixtures\ORM
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class Load100_QuestionCategory extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
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
    public function getOrder()
    {
        return 100;
    }

}
