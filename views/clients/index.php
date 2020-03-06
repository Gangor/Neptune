<?php
    $title = "Liste des clients";
?>

<div class="mt-5"></div>
<h2 class="text-center"><?php echo $title ?></h2>
<div class="mt-5"></div>

<div class="container">
    <a href="/clients/create" class="btn btn-primary float-right">Ajouter</a>
</div>

<?php $this->renderPartial( VIEWS. '/shared/_search.php', $models ) ?>
<div class="mt-3"></div>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width:30%;">Civilité</th>
                <th style="width:30%;">Prénom</th>
                <th style="width:30%;">Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $users as $user) { ?>
                <tr>
                    <th><?php echo $user->civilite ?></th>
                    <th><?php echo $user->prenom ?></th>
                    <th><?php echo $user->nom ?></th>
                    <th>
                        <a class="btn btn-warning" href="/clients/edit/<?php echo $user->id ?>"><i class="fa fa-pen"></i></a>
                        <a class="btn btn-danger" href="/clients/delete/<?php echo $user->id ?>"><i class="fa fa-trash"></i></a>
                    </th>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="mt-5"></div>