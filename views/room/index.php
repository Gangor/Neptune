<?php
    $title = "Chambres";
?>

<div class="mt-5"></div>
<div class="container">

    <?php if ( $user->admin ) { ?>
        <a href="/room/create" class="btn btn-success float-right">Ajouter</a>
    <?php } ?>

    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row">
        <?php 
            foreach( $models as $room )
                $this->renderPartial( VIEWS. '/room/_room.php', $room );
        ?>
    </div>
</div>
<div class="mt-5"></div>