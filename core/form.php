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
        $error = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $attr == 'Error' )
                continue;

            if ( $attr == "" )
                $attribute .= ' '.$val.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }
            
        if ( $attrs[ 'Error' ] )
        {
            $error = '<span id="'. $attrs[ 'id' ] .'-error">'. $attrs[ 'Error' ] .'</span>';
            $attribute .= ' aria-describedby="'. $attrs[ 'id' ] .'-error" aria-invalid="false"';
        }

        echo '<span class="text-danger field-validation-error">'. $error .'</span>';

        if ( $attrs[ 'type' ] == 'checkbox' )
            echo '<input '. $attribute .' '. ( boolval( $value ) ? 'checked="true"' : '') .'" />';
        else
            echo '<input '. $attribute .' value="'. $value .'" />';
    }

    /**
     * 
     * Génére une liste de sélection à partir des informations transmits en paramètre
     * 
     * @param   array $attr     Personnalisation des attributs
     * @param   array $list     Données de référence
     * @param   array $fields   Champs utilisé par la liste de sélection
     * @param   string $value   Valeur de l'input
     * 
     */
    static function Select( array $attrs, array $lists, ?array $fields = null, ?string $value = "" )
    {
        $attribute = '';
        $error = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $attr == 'Error' )
                continue;

            if ( $attr == '' )
                $attribute .= ' '.$val.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }
            
        if ( $attrs[ 'Error' ] )
        {
            $error = '<span id="'. $attrs[ 'id' ] .'-error">'. $attrs[ 'Error' ] .'</span>';
            $attribute .= ' aria-describedby="'. $attrs[ 'id' ] .'-error" aria-invalid="false"';
        }

        echo '<span class="text-danger field-validation-error">'. $error .'</span>';
        echo '<select '. $attribute .'>';

        if ( $value == null )
            echo '<option selected disabled hidden>Sélectionnez une valeur</option>';

        foreach ($lists as $item)
        {
            $attr = '';

            if ( $fields != null )
            {
                if ( $value == $item[ $fields[ 0 ] ] )
                    $attr = ' selected';            
    
                echo '<option value="'. $item[ $fields[ 0 ] ] .'"'.$attr.'>'.$item[ $fields[ 1 ] ].'</option>';
            }
            else
            {
                if ( $value == $item )
                    $attr = ' selected';            
    
                echo '<option value="'. $item .'"'.$attr.'>'.$item.'</option>';
            }
        }

        echo '</select>';
    }
}

?>