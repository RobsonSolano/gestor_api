<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class LancamentosValidator.
 *
 * @package namespace App\Validators;
 */
class LancamentosValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'auth_admin_id' => 'required',
            'tipo_id' => 'required',
            'titulo' => 'required',
            'valor' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
