<?php
    $title = "Supprimer une réservation";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="text-center">
        <h5>Êtes-vous sur de vouloir supprimer ceci?</h5>
        <dl class="dl-horizontal">
            <dt>Chambre n°</dt>
            <dd><?php echo $models->numero ?></dd>
            <dt>Date de debut</dt>
            <dd><?php echo $models->debut ?></dd>
            <dt>Date de fin</dt>
            <dd><?php echo $models->fin ?></dd>
        </dl>

        <form id="delete" name="delete" action="/manage/deleteReservationConfirm/<?php echo $models->tid ?>" method="post">
            <div class="form-actions no-color">
                <div class="form-group text-center">
                    <input type="submit" value="Supprimer" class="btn btn-danger" />
                    <a class="btn btn-primary" href="/manage/reservations">Retour</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>