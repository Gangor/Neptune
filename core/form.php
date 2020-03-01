<?php

class Form
{    
    static function Input( string $type, array $attrs, string $name = "", string $value = "" )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $attr == "" )
                $attribute .= ' '.$val.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }

        if ( isset( $_POST[ $name ] ) )
            $value = $_POST[ $name ];

        echo '<input type="'. $type .'" id="'. $name .'" name="'. $name .'" class="form-control" value="'. $value .'"'. $attribute .' />';
    }

    static function Select( array $attrs, string $name, array $lists, array $fields )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
        {
            if ( $val == "" )
                $attribute .= ' '.$attr.'';
            else
                $attribute .= ' '.$attr.'="'.$val.'"';
        }

        echo '<select id="'. $name .'" name="'. $name .'" class="form-control"'. $attribute .'>';

        foreach ($lists as $item)
        {
            $selected = "";

            if ( isset( $_POST[ $name ] ) )
                if ( $_POST[ $name ] == $item[ $fields[ 0 ] ] )
                    $selected = ' selected';

            echo '<option value="'. $item[ $fields[ 0 ] ] .'"'.$selected.'>'.$item[ $fields[ 1 ] ].'</option>';
        }

        echo '</select>';

    }
}

?>