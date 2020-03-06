<?php
    $title = "Mes réservations";
?>

<div class="mt-5"></div>
<h2 class="text-center"><?php echo $title ?></h2>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/_search.php', $models ) ?>
<div class="mt-3"></div>

<div class="container">
    <div class="mt-3"></div>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Chambre N°</th>
                <th>Etage</th>
                <th>Capacité</th>
                <th>Debut</th>
                <th>Fin</th>
                <th>Prix TTC</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $reservations as $reservation ) { ?>
                <tr>
                    <th><?php echo $reservation->numero ?></th>
                    <th><?php echo $reservation->etage ?></th>
                    <th><?php echo $reservation->capacite ?></th>
                    <th><?php echo date( 'd/m/Y', strtotime( $reservation->debut ) ) ?></th>
                    <th><?php echo date( 'd/m/Y', strtotime( $reservation->fin ) ) ?></th>
                    <th><?php echo $reservation->prix ?>€</th>
                    <th class="text-right">
                        <a class="btn btn-secondary" href="/manage/invoice/<?php echo $reservation->tid ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
                        <?php if ( $reservation->paye == 0 ) { ?>
                            <a class="btn btn-success" href="/billing/buy/<?php echo $reservation->tid ?>">Payer</a>
                            <a class="btn btn-danger" href="/manage/deleteReservation/<?php echo $reservation->tid ?>"><i class="fa fa-trash"></i></a>
                        <?php } ?>
                    </th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>