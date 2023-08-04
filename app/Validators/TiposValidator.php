<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TiposValidator.
 *
 * @package namespace App\Validators;
 */
class TiposValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'titulo' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
