<?php
    $title = 'Synthèse de votre réservation';
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6 text-center">

            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="room"><p class="text-center">Réservation</p></li>
                <li id="payment"><p class="text-center">Paiement</p></li>
                <li id="confirm"><p class="text-center">Fin</p></li>
            </ul> <!-- fieldsets -->

            <p>Félicitation votre réservation a été valider avec succès.</p>

            <div class="mt-3"></div>
            <dl class="dl-horizontal">
                <dt>Chambre n° <?php echo $models->numero ?></dt>
                <dt>Etage <?php echo $models->etage ?></dt>
                <dt>Date de début : <?php echo date( 'd/m/Y', strtotime( $models->debut ) ) ?></dt>
                <dt>Date de Fin : <?php echo date( 'd/m/Y', strtotime( $models->fin ) ) ?></dt>
                <dt>Prix : <?php echo $models->prix ?>€</dt>
            </dl>

            <p class="text-center">
                <th><a class="btn btn-success" href="/billing/buy/<?php echo $models->tid ?>">Payer</a></th>
                <th><a class="btn btn-danger" href="/manage/deleteReservation/<?php echo $models->tid ?>">Annuler ma réservation</a></th>
            </p>

            <p>Vous pouvez à toute moment annuler ou payer plus tard en consultant la page réservations de votre espace membre.</p>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'reserve' ); ?>
