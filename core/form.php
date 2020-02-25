<?php

class Form
{
    static function Begin( string $name, string $action = "", string $method = "post" )
    {
        echo "<form id=\"$name\" name=\"$name\" action=\"$action\" method=\"$method\">";
    }
    
    static function Input( string $type, array $attrs, string $name = "", string $value = "" )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
            $attribute .= "$attr=\"$val\" ";

        if ( isset( $_POST[ $name ] ) )
            $value = $_POST[ $name ];

        echo "<input type=\"$type\" $attribute id=\"$name\" name=\"$name\" class=\"form-control\" value=\"$value\" />";
    }

    static function Select( array $attrs, string $name, array $lists, array $fields )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
            $attribute .= "$attr=\"$val\" ";

        echo "<select id=\"$name\" name=\"$name\" class=\"form-control\" $attribute>";

        foreach ($lists as $item)
        {
            $selected = "";

            if ( isset( $_POST[ $name ] ) )
                if ( $_POST[ $name ] == $item[ $fields[ 0 ] ] )
                    $selected = ' selected';

            echo '<option value="'. $item[ $fields[ 0 ] ] .'"'.$selected.'>'.$item[ $fields[ 1 ] ].'</option>';
        }

        echo "</select>";

    }

    static function End()
    {
        echo "</form>";
    }
}

?>