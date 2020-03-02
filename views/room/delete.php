<?php
    $title = "Supprimer une chambres";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <h3>Êtes-vous sur de vouloir supprimer ceci?</h3>
    <div>
        <dl class="dl-horizontal">
            <dt>Numero</dt>
            <dd><?php echo $room->numero ?></dd>
        </dl>

        <form id="delete" name="delete" action="/room/deleteConfirm/<?php echo $room->numero ?>" method="post">
            <div class="form-actions no-color">
                <input type="submit" value="Supprimer" class="btn btn-danger" />
                <a class="btn btn-primary" href="/room">Retour</a>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>