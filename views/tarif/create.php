<?php
    $title = 'Ajouter un tarif';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="create" name="create" action="/tarif/createConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>
            
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Prix' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Prix' ], $models->Prix ) ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="Confirmer" class="btn btn-success" />
                    <a class="btn btn-primary" href="/tarif">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'create' ); ?>