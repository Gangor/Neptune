<?php
    $title = "Liste des tarifs";
?>

<div class="mt-5"></div>
<h2 class="text-center"><?php echo $title ?></h2>
<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <a href="/tarif/create" class="btn btn-success float-right">Ajouter</a>
            <div class="mt-5"></div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:50%">#</th>
                        <th style="width:50%">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $models as $tarif) { ?>
                        <tr>
                            <th><?php echo $tarif->id ?></th>
                            <th><?php echo $tarif->prix ?>€</th>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>