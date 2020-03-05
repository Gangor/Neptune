<?php
    $title = "Inscription";
?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>
            <form id="register" name="register" action="/user/registerConfirm" method="post">
                <div class="text-center text-danger">
                    <div class="mb-3"></div>
                    <?php echo $error; ?>
                    <div class="mb-3"></div>
                </div>

                <h5 class="text-center">Information de connexion</h5>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Email' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Email' ], $models->Email ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Password' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Password' ], $models->Password ) ?>
                </div>
                <div class="mb-3"></div>

                <h5 class="text-center">Information personnelle</h5>

                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Civilite' ] ) ?>
                    <?php Form::Select( $models->Validations[ 'Civilite' ], $models->civilites, null, $models->Civilite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Pays' ] ) ?>
                    <?php Form::Select( $models->Validations[ 'Pays' ], $pays, array( 'id', 'nom' ), $models->Pays ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Prenom' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Prenom' ], $models->Prenom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Nom' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Nom' ], $models->Nom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Adresse' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Adresse' ], $models->Adresse ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Ville' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Ville' ], $models->Ville ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'CodePostal' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'CodePostal' ], $models->CodePostal ) ?>
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

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'register' ); ?>
