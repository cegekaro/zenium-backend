<?php


namespace Zenium\ApiBundle\Service;


use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Handles the processing of various exception messages so that they can be easily
 * returned by the API.
 *
 * @package ApiBundle\Service
 * @author  Petre Pătrașc <petre@dreamlabs.ro>
 */
class ExceptionProcessingService
{
    /**
     * Process the validation list so that errors can be easily displayed in the API.
     *
     * @param ConstraintViolationListInterface $list
     *
     * @return array
     */
    public function processValidationErrorsIntoJsonArray(ConstraintViolationListInterface $list)
    {
        $processedData = [];

        /** @var ConstraintViolation $element */
        foreach ($list as $element) {
            $processedData[$element->getPropertyPath()] = $element->getMessage();
        }

        return $processedData;
    }
}
