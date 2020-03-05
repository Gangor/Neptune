<?php
    $title = 'Ajouter une chambre';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="create" name="create" action="/room/createConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>
            
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Capacite' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Capacite' ], $models->Capacite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Exposition' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Exposition' ], $models->Exposition ) ?>
                </div>
                <div class="form-check">
                    <?php Form::Input( $models->Validations[ 'Douche' ], $models->Douche ) ?>
                    <?php Form::Label( $models->Validations[ 'Douche' ] ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Etage' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Etage' ], $models->Etage ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Tarif' ] ) ?>
                    <?php Form::Select( $models->Validations[ 'Tarif' ], $tarifs, array( 'id', 'prix' ), $models->Tarif ) ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="Confirmer" class="btn btn-success" />
                    <a class="btn btn-primary" href="/room">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'create' ); ?>