<?php

declare(strict_types=1);

namespace ActivityPhp\Type\Validator;

use ActivityPhp\Type\Validator;
use ActivityPhp\Type\ValidatorInterface;
use ActivityPhp\Type\ValidatorTools;

/**
 * \ActivityPhp\Type\Validator\SummaryMapValidator is a dedicated
 * validator for summaryMap attribute.
 */
final class SummaryMapValidator implements ValidatorInterface
{

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Validate a summaryMap attribute value
     *
     * @param string  $value
     * @param mixed   $container An Object type
     * @return bool
     */
    public function validate($value, $container)
    {
        return ValidatorTools::validateMap('summary', $value, $container, $this->validator);
    }
}
