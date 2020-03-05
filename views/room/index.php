<?php
    $title = "Chambres";
?>

<div class="mt-5"></div>
<div class="container">

    <?php if ( isset( $user ) && $user->admin ) { ?>
        <a href="/room/create" class="btn btn-success float-right">Ajouter</a>
    <?php } ?>

    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>

    <?php $this->renderPartial( VIEWS. '/shared/_search.php', $models ) ?>

    <div class="mt-3"></div>
    <div class="row">
        <?php foreach( $rooms as $room ) $this->renderPartial( VIEWS. '/room/_room.php', $room ); ?>
        <?php if ( empty( $rooms ) ) { ?>
            <h3 class="text-center">Aucun résultat...</h3>
        <?php } ?>
    </div>
</div>
<div class="mt-5"></div>