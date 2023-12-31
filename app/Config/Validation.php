<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $login = [
        'email' => 'required|valid_email',
        'password' => 'required',
    ];

    public $register = [
        'email' => 'required|valid_email',
        'password' => 'required',
        'repeatpassword' => 'required',
        'agb' => 'required',
        'username' => 'required'
    ];

    public $register_errors = [
        'agb' => [
            'required' => 'Please Accept the terms and conditions.'
        ],
        'repeatpassword' => [
            'required' => 'Please repeat your password.'
        ],
    ];

    public $insertChangesProfile = [
        'email' => 'required|valid_email',
        'username' => 'required',
        'password_old' => 'required',
    ];

    public $insertChangesProfile_errors = [
        'password_old' => [
            'required' => 'Please enter your current password to verify changes.'
        ],
    ];
}
