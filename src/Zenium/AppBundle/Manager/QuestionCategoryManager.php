<?php


namespace Zenium\AppBundle\Manager;

use Zenium\AppBundle\Repository\AbstractBaseRepository;

/**
 * Manager operations available for Question Categories.
 *
 * @package AppBundle\Manager
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class QuestionCategoryManager extends AbstractManager
{
    /**
     * Retrieve the repository of the Entity class.
     *
     * @return AbstractBaseRepository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository('AppBundle:QuestionCategory');
    }
}
