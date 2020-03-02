<?php

class Form
{    
    /**
     * 
     * Génére un champs de formulaire à partir des informations transmits en paramètre
     * 
     * @param   string $type    Type d'input
     * @param   array $attr     Personnalisation des attributs
     * @param   string $name    Identifiant de l'input
     * @param   string $value   Valeur de l'input
     * 
     */
    static function Input( array $attrs, ?string $value = "" )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $attr == "" )
                $attribute .= ' '.$val.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }

        if ( $attrs[ 'type' ] == 'checkbox' )
            echo '<input '. $attribute .' '. ( boolval( $value ) ? 'checked="true"' : '') .'" />';
        else
            echo '<input '. $attribute .' value="'. $value .'" />';
    }

    /**
     * 
     * Génére une liste de sélection à partir des informations transmits en paramètre
     * 
     * @param   string $name    Identifiant de l'input
     * @param   array $attr     Personnalisation des attributs
     * @param   array $list     Données de référence
     * @param   array $fields   Champs utilisé par la liste de sélection
     * @param   string $value   Valeur de l'input
     * 
     */
    static function Select( array $attrs, array $lists, array $fields, ?string $value = "" )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $attr == "" )
                $attribute .= ' '.$val.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }

        echo '<select '. $attribute .'>';

        foreach ($lists as $item)
        {
            $attr = '';

            if ( $value == $item[ $fields[ 0 ] ] )
                $attr = ' selected';            

            echo '<option value="'. $item[ $fields[ 0 ] ] .'"'.$attr.'>'.$item[ $fields[ 1 ] ].'</option>';
        }

        echo '</select>';

    }
}

?>