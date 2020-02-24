<?php
    $title = "Connexion";
?>

<div class="parallax" style="background-image: url('../assets/images/piscine-restaurant.jpg')">
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>
            <?php Form::Begin( "login" ) ?>

                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Email", "class" => "form-control"), "email", "" ) ?>
                </div>

                <div class="form-group">
                    <?php Form::Input( "password", array( "placeholder" => "Mot de passe", "class" => "form-control"), "password", "" ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                </div>
            <?php Form::End( ) ?>
        </div>
    </div>
</div>