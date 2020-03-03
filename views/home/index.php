<?php
    $title = "Accueil";
?>

<div id="home-background" class="col-md-12">
    <div class="container">Accueil</div>
</div>

<div class="mt-5"></div>
<div class="container">
    <h2 class="text-center"><?php echo $title ?></h2>
    <div class="mt-5"></div>
    <div class="row">
        <?php 
            foreach( $rooms as $room )
                $this->renderPartial( VIEWS. '/room/_room.php', $room );
        ?>
    </div>
    <div class="mt-5"></div>
    <div class="text-center">
        <a class="btn btn-primary" href="/room">Afficher plus</a>
    </div>
</div>
<div class="mb-5"></div>
