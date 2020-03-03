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
                    <label for="Capacite" class="label-control">Capacité *</label>
                    <?php Form::Input( $models->Validations[ 'Capacite' ], $models->Capacite ) ?>
                </div>
                <div class="form-group">
                    <label for="Exposition" class="label-control">Exposition *</label>
                    <?php Form::Input( $models->Validations[ 'Exposition' ], $models->Exposition ) ?>
                </div>
                <div class="form-check">
                    <?php Form::Input( $models->Validations[ 'Douche' ], $models->Douche ) ?>
                    <label for="Douche" class="form-check-label">Douche</label>
                </div>
                <div class="form-group">
                    <label for="Etage" class="label-control">Etage *</label>
                    <?php Form::Input( $models->Validations[ 'Etage' ], $models->Etage ) ?>
                </div>
                <div class="form-group">
                    <label for="Tarif" class="label-control">Prix (Euro) *</label>
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