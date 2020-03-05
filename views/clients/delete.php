<?php
    $title = "Supprimer un utilisateur";
?>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="text-center">
        <h5>Êtes-vous sur de vouloir supprimer ceci?</h5>
        <dl class="dl-horizontal">
            <dt>Utilisateur</dt>
            <dd><?php echo $models->prenom. ' ' .$models->nom ?></dd>
        </dl>

        <form id="delete" name="delete" action="/clients/deleteConfirm/<?php echo $models->id ?>" method="post">
            <div class="form-actions no-color">
                <div class="form-group text-center">
                    <input type="submit" value="Supprimer" class="btn btn-danger" />
                    <a class="btn btn-primary" href="/clients">Retour</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-5"></div>