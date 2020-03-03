<?php
    $title = "Inscription";
    $civilites = [
        [ 'value' => 'Monsieur' ],
        [ 'value' => 'Mademoiselle' ],
        [ 'value' => 'Madame' ],
    ];
?>

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
                    <?php Form::Input( $model->Validations[ 'Email' ], $model->Email ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Password' ], $model->Password ) ?>
                </div>
                <div class="mb-3"></div>

                <h5 class="text-center">Information personnelle</h5>

                <div class="form-group">
                    <?php Form::Select( $model->Validations[ 'Civilite' ], $civilites, array( 'value', 'value' ), $model->Civilite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Select( $model->Validations[ 'Pays' ], $pays, array( 'id', 'nom' ), $model->Pays ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Prenom' ], $model->Prenom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( $model->Validations[ 'Nom' ], $model->Nom ) ?>
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

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php 
$this->section[ "scripts" ] = 
'
    <script>
        $("#register").validate({ lang: \'fr\' });
    </script>
'; 
?>
