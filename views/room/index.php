<?php
    $title = "Chambres";
?>

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
</div>
<div class="mt-5"></div>