<?php
    $title = "Mon compte";
    $civilites = [
        [ 'value' => 'Monsieur' ],
        [ 'value' => 'Mademoiselle' ],
        [ 'value' => 'Madame' ],
    ];
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
                    <?php Form::Select( $model->Validations[ 'Civilite' ], $civilites, array( 'value', 'value' ), $model->Civilite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Prenom' ], $model->Prenom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Nom' ], $model->Nom ) ?>
                </div>

                <?php if ( !$user->admin ) { ?>
                    <div class="form-group">
                    <?php Form::Select( $model->Validations[ 'Pays' ], $pays, array( 'id', 'nom' ), $model->Pays ) ?>
                    </div>
                    <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Adresse' ], $model->Adresse ) ?>
                    </div>
                    <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Ville' ], $model->Ville ) ?>
                    </div>
                    <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'CodePostal' ], $model->CodePostal ) ?>
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

<?php 
$this->section[ "scripts" ] = 
'
    <script>
        $("#edit").validate({ lang: \'fr\' });
    </script>
'; 
?>
