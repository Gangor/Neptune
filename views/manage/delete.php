<?php
    $title = "Supprimer de mon compte";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="text-center">
        <h5>Êtes-vous sur de vouloir supprimer votre compte?</h5>
        <form id="delete" name="delete" action="/manage/deleteConfirm" method="post">
            <div class="form-actions no-color">
                <div class="form-group text-center">
                    <input type="submit" value="Supprimer" class="btn btn-danger" />
                    <a class="btn btn-primary" href="/manage/edit">Retour</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>