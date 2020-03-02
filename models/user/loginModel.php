<?php

include_once CORE. "/model.php";

class LoginModel extends Model
{
    /**
     * Email (Require)
     * @var string $email
     */
    public $Email;

    /**
     * Password (Require)
     * @var string $email
     */
    public $Password;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Email' => [
            'type'          => 'email',
            'id'            => 'Email',
            'name'          => 'Email',
            'maxlength'     => '60',
            'placeholder'   => 'Email *',
            'class'         => 'form-control',
            'required'      => ''
        ],

        'Password' => [ 
            'type'          => 'password',
            'id'            => 'Password',
            'name'          => 'Password',
            'maxlength'     => '50', 
            'placeholder'   => 'Mot de passe *', 
            'class'         => 'form-control', 
            'required'      => ''
        ]
    );
}

?>