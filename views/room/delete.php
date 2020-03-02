<?php
    $title = "Supprimer une chambres";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="text-center">
        <h5>Êtes-vous sur de vouloir supprimer ceci?</h5>
        <dl class="dl-horizontal">
            <dt>Chambre n°</dt>
            <dd><?php echo $room->numero ?></dd>
        </dl>

        <form id="delete" name="delete" action="/room/deleteConfirm/<?php echo $room->numero ?>" method="post">
            <div class="form-actions no-color">
                <div class="form-group text-center">
                    <input type="submit" value="Supprimer" class="btn btn-danger" />
                    <a class="btn btn-primary" href="/room">Retour</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>