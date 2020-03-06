<?php
    $title = "Paiement d'une réservation";
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">

            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="room"><p class="text-center">Réservation</p></li>
                <li class="active" id="payment"><p class="text-center">Paiement</p></li>
                <li id="confirm"><p class="text-center">Fin</p></li>
            </ul> <!-- fieldsets -->
            
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>
            
            <table class="table-borderless col-md-12">
                <tbody>
                    <tr class="font-weight-bold">
                        <td>Total TTC</td>
                        <td class="text-right"><?php echo $reservation->prix ?>€</td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <p>Simulateur de paiement en ligne</p>

            <form id="buy" name="buy" action="/billing/buyConfirm/<?php echo $reservation->tid ?>" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Nom' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Nom' ], $models->Nom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Numero' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Numero' ], $models->Numero ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Mois' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Mois' ], $models->Mois ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Annee' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Annee' ], $models->Annee ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Cryptogramme' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Cryptogramme' ], $models->Cryptogramme ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'buy' ); ?>