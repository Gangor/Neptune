<?php
    $title = 'Confirmer votre réservation';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="reserve" name="reserve" action="/room/reserveFinish/<?php echo $room->numero ?>" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <p>Ce créneaux est disponible pour cette chambre, plus qu'une étape pour valider votre réservation.</p>

                <div class="mt-3"></div>

                <dl class="dl-horizontal">
                    <dt>Chambre n° <?php echo $room->numero ?></dt>
                    <dt>Prix : <?php echo $price * $room->prix ?>€</dt>
                </dl>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php Form::Label( $models->Validations[ 'Debut' ] ) ?>
                            <?php Form::Input( $models->Validations[ 'Debut' ], $models->Debut ) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php Form::Label( $models->Validations[ 'Fin' ] ) ?>
                            <?php Form::Input( $models->Validations[ 'Fin' ], $models->Fin ) ?>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <?php Form::Input( $models->Validations[ 'Valider' ], $models->Valider ) ?>
                    <?php Form::Label( $models->Validations[ 'Valider' ] ) ?>
                </div>

                <div class="form-group text-center">
                    <input type="submit" value="Confirmer" class="btn btn-success" />
                    <a class="btn btn-primary" href="/room">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'reserve' ); ?>
