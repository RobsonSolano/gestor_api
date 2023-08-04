<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ClientesValidator.
 *
 * @package namespace App\Validators;
 */
class ClientesValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'auth_admin_id' => 'required',
            'nome' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'auth_admin_id' => 'required',
            'nome' => 'required'
        ],
    ];
}
