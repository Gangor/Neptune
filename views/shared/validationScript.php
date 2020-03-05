<?php 

$this->section[ "scripts" ] = 
'
    <script>
        $.validator.addMethod(
            "email",
            function(value, element){
                return this.optional(element) || /(^[-!#$%&\'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&\'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
            },
            "Veuillez fournir une adresse électronique valide."
        );

        $.validator.addMethod(
            "greaterThan",
            function(value, element, params) {
                var target = $(params).val();
                var isValueNumeric = !isNaN(parseFloat(value)) && isFinite(value);
                var isTargetNumeric = !isNaN(parseFloat(target)) && isFinite(target);
                if (isValueNumeric && isTargetNumeric) {
                    return Number(value) > Number(target);
                }
        
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date(target);
                }
        
                return false;
            },
            "Doit être supérieur à la date de début.");
        
        $("#'. $models .'").validate({ 
            lang: "fr",
            errorClass: "is-invalid",
            validClass: "is-valid",
            errorElement: "span",
            errorPlacement: function(error, element) {
                (element).nextAll(".field-validation-error").eq(0).html(error);
            },
        });
    </script>
';

?>