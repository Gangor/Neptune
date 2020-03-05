<?php
    $title = 'Editer une chambre';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="edit" name="edit" action="/room/editConfirm/<?php echo $room->numero ?>" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <?php if ( isset( $success ) ) { ?>
                    <p class="text-center text-success">La chambre a été mise à jour avec succès.</p>
                <?php } ?>

                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Numero' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Numero' ], $models->Numero ) ?>
                </div>
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
        <div class="col-md-6">
            <?php $this->renderPartial( VIEWS. '/room/_upload.php', $upload ) ?>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'edit' ); ?>
