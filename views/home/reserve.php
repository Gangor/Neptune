<?php
    $title = 'Réserver une chambre';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form id="reserve" name="reserve" action="/home/reserveSearch" method="post">
                <div class="text-danger"><?php echo $error; ?></div>
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
            </form>
            <div class="mt-3"></div>
        </div>
    </div>

    <hr>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="mt-3"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Chambre</th>
                        <th>Capacité</th>
                        <th></th>
                        <th>Prix TTC</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $rooms as $room ) {
                            $debut = DateTime::createFromFormat('Y-m-d', $models->Debut);
                            $fin = DateTime::createFromFormat('Y-m-d', $models->Fin);
                            $days = $fin->diff($debut)->format("%a");
                        ?>
                        <tr>
                            <th>N° <?php echo $room->numero ?></th>
                            <th><?php echo $room->capacite ?> <i class="fas fa-male"></i></p></th>
                            <th><?php if ( $room->douche ) { ?> <i class="fas fa-bath"></i> <?php } ?></th>
                            <th><?php echo $room->prix * $days ?>€</th>
                            <th>
                                <form action="/room/reserveConfirm/<?php echo $room->numero ?>" method="post">
                                    <input type="hidden" id="Debut" name="Debut" value="<?php echo $models->Debut ?? '' ?>" />
                                    <input type="hidden" id="Fin" name="Fin" value="<?php echo $models->Fin ?? '' ?>" />
                                    <input type="submit" class="btn btn-success" value="Réserver" />
                                </form>
                            </th>
                        </tr>
                    <?php } ?>
                    <?php if ( empty( $rooms ) ) { ?>
                        <tr>
                            <th colspan="5">Aucune chambre à afficher</th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'reserve' ); ?>
