<?php
    $title = "Accueil";
?>

<div id="home-background">
    <div class="container">
        <div class="col-md-12 center-block">
            <h2 class="text-right"><?php echo $title ?></h2>
        </div>
    </div>
</div>

<div class="mt-5"></div>
<div class="container">
    <h3 class="text-center">Les chambres populaires</h3>
    <div class="mt-5"></div>
    <div class="row">
        <?php 
            foreach( $models as $room )
                $this->renderPartial( VIEWS. '/room/_room.php', $room );
        ?>
    </div>
    <div class="mt-5"></div>
    <div class="text-center">
        <a class="btn btn-primary" href="/room">Afficher plus</a>
    </div>
</div>
<div class="mb-5"></div>
