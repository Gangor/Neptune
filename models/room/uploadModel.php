<?php

include_once CORE. "/model.php";

class UploadModel extends Model
{
    /**
     * Photo (requis)
     * @var bool $Photo
     */
    public $Photo;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Photo' => [ 
            'type'          => 'file',
            'id'            => 'Photo',
            'name'          => 'Photo',
            'placeholder'   => '',
            'class'         => 'form-control',
            'accept'        => 'image/*'
        ]
    );
}

?>