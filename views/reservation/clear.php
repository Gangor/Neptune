<?php
    $title = "Supprimer toute les réservations";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="text-center">
        <h5>Êtes-vous sur de vouloir supprimer toute les réservations?</h5>
        <p>Pour confirmer cette opération veuillez saisir votre mot de passe.</p>

        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <form id="clear" name="clear" action="/reservation/clearConfirm" method="post">
                    <div class="text-center text-danger">
                        <div class="mb-3"></div>
                        <?php echo $error; ?>
                        <div class="mb-3"></div>
                    </div>
                    
                    <div class="form-group">
                        <?php Form::Label( $models->Validations[ 'Password' ] ) ?>
                        <?php Form::Input( $models->Validations[ 'Password' ], $models->Password ) ?>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Confirmer</button>
                        <a class="btn btn-primary" href="/reservation/index">Retour</a>
                    </div>
                <form>
            </div>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'clear' ); ?>
