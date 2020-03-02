<?php

include_once CORE. "/model.php";

class editPasswordModel extends Model
{
    /**
     * Ancien mot de passe (Require)
     * @var string $OldPassword
     */
    public $OldPassword;

    /**
     * Nouveau mot de passe (Require)
     * @var string $NewPassword
     */
    public $NewPassword;

    /**
     * Mot de passe de confirmation (Require)
     * @var string $Confirm
     */
    public $Confirm;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'OldPassword' => [
            'type'          => 'password',
            'id'            => 'OldPassword',
            'name'          => 'OldPassword',
            'maxlength'     => '50',
            'placeholder'   => 'Actuel *',
            'class'         => 'form-control',
            'required'      => ''
        ],

        'NewPassword' => [ 
            'type'          => 'password',
            'id'            => 'NewPassword',
            'name'          => 'NewPassword',
            'maxlength'     => '50', 
            'placeholder'   => 'Nouveau *', 
            'class'         => 'form-control', 
            'required'      => ''
        ],

        'Confirm' => [ 
            'type'          => 'password',
            'id'            => 'Confirm',
            'name'          => 'Confirm',
            'maxlength'     => '50', 
            'placeholder'   => 'Confirmation *', 
            'class'         => 'form-control', 
            'required'      => ''
        ]
    );
}

?>