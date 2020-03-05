<?php

include_once CORE. "/model.php";

class clearModel extends Model
{
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