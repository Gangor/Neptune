<?php
    $title = "Changer de mot de passe";
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2 class="text-center"><?php echo $title ?></h2>

            <div class="mb-5"></div>
            <form id="changepassword" name="changepassword" action="/manage/editpasswordConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <?php if ( isset( $success ) ) { ?>
                    <p class="text-center text-success">Votre mot de passe a été mise à jour avec succès.</p>
                <?php } ?>

                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'OldPassword' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'OldPassword' ], $models->OldPassword ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'NewPassword' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'NewPassword' ], $models->NewPassword ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Confirm' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Confirm' ], $models->Confirm ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/manage/edit">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'changepassword' ); ?>
