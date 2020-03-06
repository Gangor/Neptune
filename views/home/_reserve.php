<form id="reserve" name="reserve" action="/home/reserve" method="post">
    <div class="row justify-content-md-center">
        <div class="col-md-4 form-group">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon"><?php echo $models->Validations[ 'Debut' ][ 'placeholder' ] ?></span>
                </div>
                <?php Form::Input( $models->Validations[ 'Debut' ], $models->Debut, false ); ?>
            </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><?php echo $models->Validations[ 'Fin' ][ 'placeholder' ] ?></span>
                </div>
                <?php Form::Input( $models->Validations[ 'Fin' ], $models->Fin, false ); ?>
            </div>
        </div>
    </div>
    <div class="row justify-content-md-center form-group">
        <input type="submit" class="btn btn-success btn-lg" value="Réserver" />
    </div>
</form>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'reserve' ); ?>