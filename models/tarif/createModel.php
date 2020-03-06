<?php

include_once CORE. "/model.php";

class CreateModel extends Model
{
    /**
     * Prix (Requis)
     * @var string $Prix
     */
    public $Prix;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Prix' => [ 
            'type'          => 'number',
            'id'            => 'Prix',
            'name'          => 'Prix',
            'placeholder'   => 'Prix *',
            'class'         => 'form-control'
        ]
    );
}

?>