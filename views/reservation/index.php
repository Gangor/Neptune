<?php
    $title = "Liste des réservations";
?>

<div class="mt-5"></div>
<h2 class="text-center"><?php echo $title ?></h2>
<div class="mt-5"></div>

<div class="container">
    <a href="/reservation/clear" class="btn btn-danger float-right">Supprimer tous</a>
</div>
<?php $this->renderPartial( VIEWS. '/shared/_search.php', $models ) ?>
<div class="mt-3"></div>

<div class="container">
    <div class="mt-3"></div>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Civilité</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Chambre</th>
                <th>Debut</th>
                <th>Fin</th>
                <th>Prix</th>
                <th>Etat</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $reservations as $reservation) { ?>
                <tr>
                    <th><?php echo $reservation->civilite ?></th>
                    <th><?php echo $reservation->prenom ?></th>
                    <th><?php echo $reservation->nom ?></th>
                    <th><?php echo $reservation->numero ?></th>
                    <th><?php echo date( 'd/m/Y', strtotime( $reservation->debut ) ) ?></th>
                    <th><?php echo date( 'd/m/Y', strtotime( $reservation->fin ) ) ?></th>
                    <th><?php echo $reservation->prix ?>€</th>
                    <th><?php echo $reservation->paye == '-1' ? 'Payé' : 'En attente' ?></th>
                    <th>
                        <a class="btn btn-secondary" href="/reservation/invoice/<?php echo $reservation->tid ?>" target="_blank"><i class="fa fa-file-pdf"></i></a>
                        <a class="btn btn-danger" href="/reservation/delete/<?php echo $reservation->tid ?>"><i class="fa fa-trash"></i></a>
                    </th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>