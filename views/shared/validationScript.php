<?php 

$this->section[ "scripts" ] = 
'
    <script>

        $.validator.addMethod( //override email with django email validator regex - fringe cases: "user@admin.state.in..us" or "name@website.a"
            "email",
            function(value, element){
                return this.optional(element) || /(^[-!#$%&\'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&\'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
            },
            "Veuillez fournir une adresse électronique valide."
        );
        
        $("#'. $models .'").validate({ 
            lang: "fr",
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorElement: "span",
            errorPlacement: function(error, element) {
                (element).prevAll(".field-validation-error").eq(0).html(error);
            },
        });
    </script>
';

?>