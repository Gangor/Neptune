<?php

include_once CORE. "/model.php";

class SearchModel extends Model
{
    /**
     * Recherche (optionnel)
     * @var bool $Search
     */
    public $Search;

    /**
     * Fields validations
     */
    public $Validations = array
    (
        'Search' => [ 
            'type'          => 'text',
            'id'            => 'Search',
            'name'          => 'Search',
            'placeholder'   => 'Rechercher',
            'class'         => 'form-control mb-2'
        ]
    );
}

?>