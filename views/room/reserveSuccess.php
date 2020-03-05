<?php
    $title = 'Synthèse de votre réservation';
    $debut = DateTime::createFromFormat('Y-m-d H:i:s', (string)$models->debut);
    $fin = DateTime::createFromFormat('Y-m-d H:i:s', (string)$models->fin);
    $days = $fin->diff($debut)->format("%a") + 1;
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <p>Félicitation votre réservation a été valider avec succès.</p>

            <div class="mt-3"></div>
            <dl class="dl-horizontal">
                <dt>Chambre n° <?php echo $models->numero ?></dt>
                <dt>Etage <?php echo $models->etage ?></dt>
                <dt>Date de début : <?php echo $debut->format( 'd-m-y' ) ?></dt>
                <dt>Date de Fin : <?php echo $fin->format( 'd-m-y' ) ?></dt>
                <dt>Prix : <?php echo $days * $models->prix ?>€</dt>
            </dl>

            <p>Vous pouvez à toute moment annuler votre réservation dans votre espace membre.</p>
        </div>
    </div>
</div>
<div class="mt-5"></div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'reserve' ); ?>
