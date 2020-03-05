<?php
    $title = "Mon compte";
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>

            <hr>
            
            <h5 class="text-center">Modifier le mot de passe</h5>
            <div class="text-center">
                <a class="btn btn-success" href="/manage/editpassword">Modifier</a>
            </div>

            <hr>

            <form id="edit" name="edit" action="/manage/editConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <?php if ( isset( $success ) ) { ?>
                    <p class="text-center text-success">Vos informations personnelles ont été mise à jour avec succès.</p>
                <?php } ?>

                <h5 class="text-center">Modifier les informations personnelles</h5>

                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Civilite' ] ) ?>
                    <?php Form::Select( $models->Validations[ 'Civilite' ], $models->civilites, null, $models->Civilite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Prenom' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Prenom' ], $models->Prenom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Nom' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Nom' ], $models->Nom ) ?>
                </div>

                <?php if ( !$user->admin ) { ?>
                    <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Pays' ] ) ?>
                    <?php Form::Select( $models->Validations[ 'Pays' ], $pays, array( 'id', 'nom' ), $models->Pays ) ?>
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
                <?php } ?>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                </div>
            </form>

            <hr>
            
            <h5 class="text-center">Gestion du compte</h5>
            <div class="text-center">
                <a class="btn btn-warning" href="/manage/recoveData" target="_blank">Données du compte</a>
                <a class="btn btn-danger" href="/manage/delete">Supprimer mon compte</a>
            </div>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'edit' ); ?>