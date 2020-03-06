<?php

class Form
{    
    /**
     * 
     * Génére un champs de formulaire à partir des informations transmits en paramètre
     * 
     * @param   array $attr     Personnalisation des attributs
     * @param   string $value   Valeur de l'input
     * 
     */
    static function Input( array $attrs, ?string $value = "", bool $validation = true )
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

        if ( $attrs[ 'type' ] == 'checkbox' )
            echo '<input '. $attribute .' '. ( boolval( $value ) ? 'checked="true"' : '') .'" />';
        else if ( $attrs[ 'type' ] == 'file' )
            echo '<input '. $attribute .' />';
        else
            echo '<input '. $attribute .' value="'. $value .'" />';

        if ( $validation )
            echo '<span class="text-danger field-validation-error">'. $error .'</span>';
    }

    /**
     * 
     * Génére un label pour un champs à partir des informations transmits en paramètre
     * 
     * @param   array $attr     Personnalisation des attributs
     * 
     */
    static function Label( array $attrs )
    {
        if ( isset( $attrs[ 'type' ] ) && $attrs[ 'type' ] == 'checkbox' )
            echo '<label for="'. $attrs[ 'id' ] .'" class="form-check-label">'. $attrs[ 'placeholder' ] .'</label>';
        else
            echo '<label for="'. $attrs[ 'id' ] .'" class="label-control">'. $attrs[ 'placeholder' ] .'</label>';
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
        echo '<span class="text-danger field-validation-error">'. $error .'</span>';
    }
}

?>