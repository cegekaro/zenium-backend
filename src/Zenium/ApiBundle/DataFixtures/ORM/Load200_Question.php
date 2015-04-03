<?php


namespace Zenium\ApiBundle\DataFixtures\ORM;


use Zenium\AppBundle\Entity\Question;
use Zenium\AppBundle\Entity\QuestionCategory;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Loads Question fixtures.
 *
 * @package ApiBundle\DataFixtures\ORM
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class Load200_Question extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var QuestionCategory $questionCategory */
        $questionCategory = $manager->getRepository('AppBundle:QuestionCategory')->find(4);

        $seedData = [
            [
                'content' => 'Can multiple inheritance be achieved in PHP?',
                'difficulty' => 4,
            ],
            [
                'content' => 'Which of the following is a new feature in PHP 7?',
                'difficulty' => 3,
            ],
            [
                'content'    => 'What is the role of a Repository?',
                'difficulty' => 2,
            ],
        ];

        foreach ($seedData as $datum) {
            $question = new Question();
            $question->setContent($datum['content'])
                ->setDifficulty($datum['difficulty'])
                ->setQuestionCategory($questionCategory);

            $manager->persist($question);
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
        return 200;
    }

}
