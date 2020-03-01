<?php
    $title = "Inscription";
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>
            <form id="register" name="register" action="/user/registerConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <h5 class="text-center">Information de connexion</h5>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Email", "required" ), "email" ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "password", array( "placeholder" => "Mot de passe", "required" ), "password" ) ?>
                </div>
                <div class="mb-3"></div>

                <h5 class="text-center">Information personnelle</h5>

                <div class="form-group">
                    <select id="civilite" name="civilite" class="form-control">
                        <option value="Monsieur">Monsieur</option>
                        <option value="Mademoiselle">Mademoiselle</option>
                        <option value="Madame">Madame</option>
                    </select>
                </div>

                <div class="form-group">
                    <?php Form::Select( array( "required" ), "pays", $pays, array( "id", "nom" ) ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Prénom", "required" ), "firstname" ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Nom", "required" ), "lastname" ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Adresse", "required" ), "adresse" ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Ville", "required" ), "ville" ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", array( "placeholder" => "Code postal", "required" ), "codepostal" ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>