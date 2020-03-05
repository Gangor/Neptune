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

    <table class="table table-striped">
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
            <?php foreach( $reservations as $reservation) {                
                    $debut = DateTime::createFromFormat('Y-m-d H:i:s', (string)$reservation->debut);
                    $fin = DateTime::createFromFormat('Y-m-d H:i:s', (string)$reservation->fin);
                    $days = $fin->diff($debut)->format("%a") + 1;
            ?>
                <tr>
                    <th><?php echo $reservation->civilite ?></th>
                    <th><?php echo $reservation->prenom ?></th>
                    <th><?php echo $reservation->nom ?></th>
                    <th><?php echo $reservation->numero ?></th>
                    <th><?php echo $debut->format( 'd-m-y' ) ?></th>
                    <th><?php echo $fin->format( 'd-m-y' ) ?></th>
                    <th><?php echo $reservation->prix * $days ?>€</th>
                    <th><?php echo $reservation->paye == '-1' ? 'Payé' : 'En attente' ?></th>
                    <th>
                        <a class="btn btn-danger" href="/reservation/delete/<?php echo $reservation->tid ?>"><i class="fa fa-trash"></i></a>
                    </th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>