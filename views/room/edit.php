<?php
    $title = "Editer une chambres";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div>
        <form id="delete" name="delete" action="/room/editConfirm/<?php echo $room->numero ?>" method="post">
            <div class="form-actions no-color">
                <input type="submit" value="Supprimer" class="btn btn-danger" />
                <a class="btn btn-primary" href="/room">Retour</a>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>