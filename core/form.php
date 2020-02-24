<?php

class Form
{
    static function Begin( string $name, string $type = "POST" )
    {
        echo "<form name=\"$name\" type=\"$type\">";
    }
    
    static function Input( string $type, array $attrs, string $name, string $value )
    {
        $attribute = '';

        foreach ($attrs as $attr => $val )
            $attribute .= "$attr=\"$val\" ";

        echo "<input type=\"$type\" $attribute id=\"$name\" name=\"$name\" value=\"$value\" />";
    }

    static function End()
    {
        echo "</form>";
    }
}

?>